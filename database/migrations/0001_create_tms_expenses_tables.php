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
        $taskTablePrefix = config('pkg-tasks.table_prefix');

        Schema::create('app_expenses_materials', function (Blueprint $table) use ($taskTablePrefix) {
            $table->id();

            $table->date('date')
                ->nullable();
            $table->string('code')
                ->nullable();
            $table->string('title');
            $table->text('description')
                ->nullable();
            $table->decimal('price')
                ->nullable();
            $table->decimal('vat')
                ->nullable()
                ->comment('VAT in percent');
            $table->foreignId('task_id')
                ->nullable()
                ->comment('Ticket this material was used on.')
                ->constrained($taskTablePrefix . 'tasks', 'id');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('app_expenses_services', function (Blueprint $table) use ($taskTablePrefix) {
            $table->id();

            $table->date('date')
                ->nullable();
            $table->string('code')
                ->nullable();
            $table->string('title');
            $table->text('description')
                ->nullable();
            $table->decimal('price')
                ->nullable();
            $table->decimal('vat')
                ->nullable()
                ->comment('VAT in percent');
            $table->foreignId('task_id')
                ->nullable()
                ->comment('VAT in percent')
                ->constrained($taskTablePrefix . 'tasks', 'id');

            $table->timestamps();
            $table->softDeletes();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_expenses_materials');
        Schema::dropIfExists('app_expenses_services');
    }
};
