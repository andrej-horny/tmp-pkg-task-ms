<?php

namespace App\States\TS\Task;

 class Cancelled extends TaskState
{
    public static $name = "cancelled";

    public function label():string {
        return __('tasks/task.states.cancelled');
    }    
}