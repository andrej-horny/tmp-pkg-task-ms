<?php

namespace Dpb\Package\TaskMS\Commands\InspectionTemplatable;

final readonly class CreateInspectionTemplatableCommand
{
    public function __construct(
        public ?int $templateId,
        public int $templatableId,
        public string $templatableType,
    ) {}

    public function withTemplateId(int $id): self
    {
        return new self(
            templateId: $id,
            templatableId: $this->templatableId,
            templatableType: $this->templatableType,
        );
    }    
}
