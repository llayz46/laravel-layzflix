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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->integer('movie_id');
            $table->text('comment');
            $table->float('note', 6, 5);
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('bio')->nullable()->after('avatar');
            $table->json('favorite_films')->nullable()->after('bio');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('bio');
            $table->dropColumn('favorite_films');
        });

        Schema::dropIfExists('reviews');
    }
};
