<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('article_id')
                  ->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            
            $table->foreignId('user_id')
                  ->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            
            $table->foreignId('parent_id')
                  ->nullable()
                  ->constrained('comments')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            
            $table->text('content');
            $table->boolean('is_edited')->default(false);
            $table->boolean('is_flagged')->default(false);
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
};