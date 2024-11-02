<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->text('description')->nullable();
            $table->year('publication_year');
            $table->string('cover_image')->nullable(); // for book cover images
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // book owner
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null'); // optional category
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('books');
    }
};
