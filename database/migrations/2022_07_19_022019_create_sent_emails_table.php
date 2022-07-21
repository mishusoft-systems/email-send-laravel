<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('sent_emails', static function (Blueprint $table) {
            $table->id();
            $table->integer('user');
            $table->string('first_sent_date');
            $table->string('last_sent_date');
            $table->string('is_unsubscribe');
            $table->string('is_not_respond');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('sent_emails');
    }
};
