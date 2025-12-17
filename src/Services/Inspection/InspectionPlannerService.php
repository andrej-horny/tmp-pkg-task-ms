<?php

namespace Dpb\Package\TaskMS\Services\Inspection;

use Dpb\Package\Fleet\Models\Vehicle;
use Dpb\Package\TaskMS\Commands\Inspection\CreateInspectionCommand;
use Dpb\Package\TaskMS\Commands\InspectionAssignment\CreateInspectionAssignmentCommand;
use Dpb\Package\TaskMS\Models\InspectionAssignment;
use Dpb\Package\TaskMS\Models\InspectionTemplatable;
use Dpb\Package\TaskMS\Resolvers\InspectionSubjectResolver;
use Dpb\Package\TaskMS\Resolvers\InspectionTemplatableResolver;
use Dpb\Package\TaskMS\States\Inspection\Upcoming;
use Dpb\Package\TaskMS\Workflows\CreateInspectionWorkflow;

class InspectionPlannerService
{
    public function __construct(
        protected InspectionAssignment $inspectionAssignmentModel,
        protected InspectionSubjectResolver $inspectionSubjectResolver,
        protected InspectionTemplatableResolver $inspectionTemplatableResolver,
        protected CreateInspectionWorkflow $createInspectionWorkflow,
    ) {}

    public function execute()
    {
        /// get potential subjects
        $subjects = Vehicle::all();

        foreach ($subjects as $subject) {

            // get tempaltes for subject
            // $templatable = $this->inspectionTemplatableResolver->resolve('vehicle-model', $subject->model_id);
            $templates = InspectionTemplatable::whereMorphedTo('templatable', $subject->model)
                ->with('template')
                ->get()
                ->map(function ($record) {
                    return $record->template;
                });

            $inspectionSubject = $this->inspectionSubjectResolver->resolve($subject->getMorphClass(), $subject->id);
            // dd($templates);
            foreach ($templates as $template) {
                // if conditions met create inspection
                while ($this->inspectionDue($subject, $template)) {
                    // create inspection
                    $this->createInspectionWorkflow->handle(
                        // inspection
                        new CreateInspectionCommand(
                            new \DateTimeImmutable(),
                            $template->id,
                            Upcoming::$name
                        ),
                        // inspection assignment
                        new CreateInspectionAssignmentCommand(
                            null,
                            $inspectionSubject->id,
                            $inspectionSubject->morphClass,
                        )
                    );
                }
            }
        }
    }

    protected function inspectionDue($subject, $template)
    {
        // $distanceTresholReached = false;
        // $timeTresholReached = false;
        $distanceValue = 0;
        $timeValue = 0;


        $totalDistance = $subject->travelLog()->sum('distance');
        // if perodic
        if ($template->is_periodic) {
            // distance
            if ($template->treshold_distance !== null) {
                $expectedRrepetitionsCount = intdiv($totalDistance, $template->treshold_distance);

                // if all periodic already exists
                if ($expectedRrepetitionsCount > $this->existingInspectionsCount($subject, $template)) {
                    return true;
                }
                else if ($expectedRrepetitionsCount < $this->existingInspectionsCount($subject, $template)) {
                    return false;
                }

                // get amount since last inspection
                $distanceValue = $totalDistance % $template->treshold_distance;
            }
        } else {
            // if this type of inspection already exists
            if ($this->inspectionExists($subject, $template)) {
                dd('exist');
                return false;
            }

            // distance
            $distanceValue = $subject->travelLog()->sum('distance');
        }

        $distanceTresholReached = $this->distanceTresholdReached($distanceValue, $template);
        $timeTresholReached = $this->timeTresholdReached($timeValue, $template);

        return $distanceTresholReached || $timeTresholReached;
    }

    protected function existingInspectionsCount($subject, $template)
    {
        return $this->inspectionAssignmentModel
            ->whereMorphedTo('subject', $subject)
            ->whereHas('inspection.template', function ($q) use ($template) {
                $q->where('id', $template->id);
            })
            ->count();
    }

    protected function inspectionExists($subject, $template)
    {
        return $this->inspectionAssignmentModel
            ->whereMorphedTo('subject', $subject)
            ->whereHas('inspection.template', function ($q) use ($template) {
                $q->where('id', $template->id);
            })
            ->exists();
    }

    protected function distanceTresholdReached($value, $template)
    {
        if ($template->treshold_distance == null) {
            return false;
        }

        $offset = 0;
        $offset += $template->first_advance_distance ?? 0;

        return ($template->treshold_distance - $offset) < $value;
    }

    protected function timeTresholdReached($value, $template)
    {
        if ($template->treshold_time == null) {
            return false;
        }

        $offset = 0;
        $offset += $template->first_advance_time ?? 0;

        return $template->treshold_time - $offset < $value;
    }
}
