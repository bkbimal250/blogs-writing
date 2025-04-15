<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content');
            $table->text('meta_description')->nullable();
            
            $table->foreignId('user_id')
                  ->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            
            $table->foreignId('category_id')
                  ->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            
            $table->boolean('is_published')->default(false);
            $table->integer('view_count')->default(0);
            
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('article_versions', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('article_id')
                  ->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            
            $table->foreignId('user_id')
                  ->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            
            $table->longText('content');
            $table->string('reason_for_edit')->nullable();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('article_versions');
        Schema::dropIfExists('articles');
    }
};