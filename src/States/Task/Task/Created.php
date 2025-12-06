<?php

namespace App\States\TS\Task;

 class Created extends TaskState
{
    public static $name = "created";

    public function label():string {
        return __('tasks/task.states.created');
    }
}