<?php

namespace App\States\TS\TaskItem;

 class AwaitingParts extends TaskItemState
{
    public static $name = "awaiting-parts";

    public function label():string {
        return __('tasks/task-item.states.awaiting-parts');
    }    
}