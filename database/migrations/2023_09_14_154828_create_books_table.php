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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('author_id')->constrained();
            $table->foreignId('publisher_id')->constrained();
            $table->foreignId('category_id')->constrained('categories');
            $table->string('image');
                        $table->softDeletes();

            $table->longText('description');
            $table->integer('quantity');
            $table->decimal('price' , 8,2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
