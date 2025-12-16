<?php

namespace Dpb\Package\TaskMS\Data\DTOs;

use InvalidArgumentException;

class TaskSourceDTO
{
    public function __construct(
        public int|null $id,
        public string|null $morphClass,
    ) {
        if (($id === null) !== ($morphClass === null)) {
            throw new InvalidArgumentException(
                'TaskSourceDTO must have both id and morphClass or neither'
            );
        }
    }
}
