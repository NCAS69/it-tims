<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('inspection_results', function (Blueprint $table) {
            $table->foreignId('inspection_id')
                ->constrained('inspections')
                ->cascadeOnDelete()
                ->after('id');

            $table->foreignId('checklist_item_id')
                ->constrained('checklist_items')
                ->restrictOnDelete()
                ->after('inspection_id');

            $table->enum('status', [
                'normal',
                'abnormal',
                'na',
            ])
                ->default('normal')
                ->after('checklist_item_id');

            $table->text('value')
                ->nullable()
                ->after('status');

            $table->text('notes')
                ->nullable()
                ->after('value');
        });
    }

    public function down(): void
    {
        Schema::table('inspection_results', function (Blueprint $table) {
            $table->dropForeign(['inspection_id']);
            $table->dropForeign(['checklist_item_id']);

            $table->dropColumn([
                'inspection_id',
                'checklist_item_id',
                'status',
                'value',
                'notes',
            ]);
        });
    }
};