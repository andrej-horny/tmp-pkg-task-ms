<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $tablePrefix = config('pkg-task-ms.table_prefix');
        $wlTablePrefix = config('pkg-work-log.table_prefix');

        Schema::create($tablePrefix . 'work_assignments', function (Blueprint $table) use ($wlTablePrefix) {
            $table->id();
            $table->foreignId('work_interval_id')
                ->nullable(false)
                ->comment('')
                ->constrained($wlTablePrefix . 'work_intervals');
            $table->unsignedBigInteger('subject_id')
                ->nullable(false)
                ->comment('');
            $table->string('subject_type')
                ->nullable(false)
                ->comment('');
            $table->foreignId('employee_contract_id')
                ->nullable(false)
                ->comment('Contract of employee that did the work')
                ->constrained('datahub_employee_contracts', 'id');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tablePrefix = config('pkg-task-ms.table_prefix');

        Schema::dropIfExists($tablePrefix . 'work_assignments');
    }
};
