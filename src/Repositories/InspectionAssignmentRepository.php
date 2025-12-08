<?php

namespace Dpb\Package\TaskMS\Repositories;

use Dpb\Package\TaskMS\Data\Inspection\InspectionAssignmentData;
use Dpb\Package\TaskMS\MDpb\Package\TaskMSers\Inspection\InspectionAssignmentMDpb\Package\TaskMSer;
use Dpb\Package\TaskMS\MDpb\Package\TaskMSers\Inspection\InspectionMDpb\Package\TaskMSer;
use Dpb\Package\TaskMS\Models\InspectionAssignment;

class InspectionAssignmentRepository
{
    public function __construct(
        private InspectionAssignment $eloquentModel,
        private InspectionMDpb\Package\TaskMSer $inspectionMDpb\Package\TaskMSer,
        private InspectionAssignmentMDpb\Package\TaskMSer $inspectionAssignmentMDpb\Package\TaskMSer
        ) {}

    public function findById(int $id): ?InspectionAssignment
    {
        $model = $this->eloquentModel->findOrFail($id);

        return $model;
    }

    public function save(InspectionAssignmentData $inspectionAssignmentData): ?InspectionAssignment
    {
        // create inspection
        $inspection = $this->inspectionMDpb\Package\TaskMSer->toEloquent($inspectionAssignmentData->inspection);
        $inspection->save();

        $inspectionAssignment = $this->inspectionAssignmentMDpb\Package\TaskMSer->toEloquent($inspectionAssignmentData);
        // dd($inspectionAssignment);
        $inspectionAssignment->inspection()->associate($inspection);
        $inspectionAssignment->save();

        return $inspectionAssignment;
    }

    public function push(InspectionAssignment $inspectionAssignment): ?InspectionAssignment
    {
        $inspectionAssignment->push();
        return $inspectionAssignment;
    }    
}
