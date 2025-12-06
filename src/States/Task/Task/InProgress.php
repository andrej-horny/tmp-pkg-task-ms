<?php

namespace App\States\TS\Task;

 class InProgress extends TaskState
{
    public static $name = "in-progress";

    public function label():string {
        return __('tasks/task.states.in-progress');
    }    
}