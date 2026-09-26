<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('inspections', function (Blueprint $table) {
            $table->foreignId('tower_id')
                ->constrained('towers')
                ->cascadeOnDelete()
                ->after('inspection_number');

            $table->foreignId('template_id')
                ->constrained('inspection_templates')
                ->restrictOnDelete()
                ->after('tower_id');

            $table->foreignId('inspector_id')
                ->constrained('users')
                ->restrictOnDelete()
                ->after('template_id');

            $table->date('inspection_date')
                ->after('inspector_id');

            $table->time('start_time')
                ->nullable()
                ->after('inspection_date');

            $table->time('end_time')
                ->nullable()
                ->after('start_time');

            $table->enum('status', [
                'draft',
                'in_progress',
                'completed',
                'submitted',
                'approved',
                'rejected',
            ])
                ->default('draft')
                ->after('end_time');

            $table->enum('overall_status', [
                'normal',
                'abnormal',
            ])
                ->nullable()
                ->after('status');

            $table->text('notes')
                ->nullable()
                ->after('overall_status');
        });
    }

    public function down(): void
    {
        Schema::table('inspections', function (Blueprint $table) {
            $table->dropForeign(['tower_id']);
            $table->dropForeign(['template_id']);
            $table->dropForeign(['inspector_id']);

            $table->dropColumn([
                'tower_id',
                'template_id',
                'inspector_id',
                'inspection_date',
                'start_time',
                'end_time',
                'status',
                'overall_status',
                'notes',
            ]);
        });
    }
};