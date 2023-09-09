<?php

use Illuminate\Database\Migrations\Migration;
use barooei\Task\Models;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

                Schema::create('tasks', function (Blueprint $table) {
                    $table->id();
                    $table->string('title');
                    $table->text('description');

                    $table->enum('type',barooei\Task\Models\Task::$type);

                    $table->unsignedBigInteger('user_id');
                    $table->timestamps();
                });
            }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
