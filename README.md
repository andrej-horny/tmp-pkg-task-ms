# WIP

# Table of Contents

- [Introduction](#introduction)
- [Installation](#installation)
  - [Composer](#composer)
  - [Migrations](#migrations)
- [Task states](#task-states)

# Introduction

Package providing datanbase structures and models for task management.

# Installation

Package uses other packages under the hood

* Model states - 

## Composer

### 1. Add repository sources into `composer.json` file in application root directory

```json
"repositories": [
        ...,
        {
            "type": "vcs",
            "url": "git@github.com:dp-bratislava/pkg-tasks.git"
        },        
        {
            "type": "vcs",
            "url": "git@github.com:dp-bratislava/ext-spatie-model-states-.git"
        },        
        ...,
]
```

### 2. Install composer repositories

```bash
# install package
composer require dpb/pkg-tasks
```

## Migrations

First it installs migrations for spatie states package, then for tasks package itself.

```bash
# publish migrations
artisan pkg-tasks:install

# yes to create and run migrations
```

# Task states

Using [spatie model states package](https://spatie.be/docs/laravel-model-states/v2/01-introduction) we can define state matrix with states, transitions between states and rules for transitions.

[Extended spatie package](https://github.com/dp-bratislava/ext-spatie-model-states) adds ...

Specific states and transitions have to be defined in application itself. Package provides just basic abstract state that should be extended accordingly.

## 1. Default state

Add default state class to `App/States/Task` 

#### app/States/Task/TaskState.php
```php
<?php

namespace App\States\Task;

use App\StateTransitions\Task\DiscardedToInService;
use App\StateTransitions\Task\InServiceToDiscarded;
use Dpb\Package\States\TaskState as BaseTaskState;
use Spatie\ModelStates\StateConfig;

abstract class TaskState extends BaseTaskState
{
    public static function config(): StateConfig
    {
        return parent::config()
            ->default(InService::class)
            ->allowTransition(InService::class, Discarded::class, InServiceToDiscarded::class)
            ->allowTransition(Discarded::class, InService::class, DiscardedToInService::class)
        ;
    }
}
```

## 2. Default state class mapping

Add default state class mapping to pkg-tasks config

#### config/pkg-tasks.php
```php 
# config/pkg-tasks.php

    /*
    |--------------------------------------------------------------------------
    | Default class mapping
    |--------------------------------------------------------------------------
    */
    'classes' => [
        'task_state_class' => '\App\States\Task\TaskState::class',
    ],    
```

## 3. Custom states

Add custom states extending default state to `App/States/Task` 

#### app/States/Task/Discarded.php
```php
<?php

namespace App\States\Task;

class Discarded extends TaskState
{
    public static $name = "discarded";

    public function label():string {
        return __('/task.states.discarded');
    }    
}
```

## 4. Transition classes

Add transitions classes to `App/StateTransitions/Task` 

```php
<?php

namespace App\StateTransitions\Task;

use Dpb\Package\Models\Task;
use App\States\Task\Discarded;
use App\States\Task\InService;
use Illuminate\Contracts\Auth\Authenticatable;
use Spatie\ModelStates\Transition;

class DiscardedToInService extends Transition
{
    public function __construct(private Task $task, private Authenticatable $user) {}

    public function canTransition(): bool
    {
        // $userCan = app()->runningInConsole() ? true : ($this->user->can('discard-task') || $this->user->hasRole('super-admin'));
        $userCan = true;
        $validInitialState = $this->task->state->equals(Discarded::class);
        return $userCan && $validInitialState;
    }

    public function handle(): ?Task
    {
        if ($this->canTransition()) {

            $this->task->state = new InService($this->task);
            $this->task->save();

            return $this->task;
        }
        return null;
    }
}
```

## 5. Localisation

### TO DO

# Package content

### TO DO




