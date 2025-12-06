<?php

namespace App\States\TS\Task;

 class Closed extends TaskState
{
    public static $name = "closed";

    public function label():string {
        return __('tasks/task.states.closed');
    }    
}