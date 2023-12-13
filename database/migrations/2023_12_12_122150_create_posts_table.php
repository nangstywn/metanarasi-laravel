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
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid');
            $table->string('title')->nullable();
            $table->unsignedInteger('category_id')->nullable();
            $table->text('content')->nullable();
            $table->string('attachment')->nullable();
            $table->tinyInteger('favourite')->nullable();
            $table->tinyInteger('editor_pick')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
