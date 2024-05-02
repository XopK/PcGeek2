<?php

use Database\Seeders\CategoryComponent;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('component_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title_category_components');
        });

        Artisan::call('db:seed', ['--class' => CategoryComponent::class]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('component_categories');
    }
};
