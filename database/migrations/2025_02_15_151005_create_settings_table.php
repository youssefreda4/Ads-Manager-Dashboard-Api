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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->nullable();
            $table->text('about_us')->nullable();
            $table->text('why_us')->nullable();
            $table->text('goal')->nullable();
            $table->text('vision')->nullable();
            $table->text('about_footer')->nullable();
            $table->text('ads_text')->nullable();
            $table->text('activities_text')->nullable();
            $table->text('person_text')->nullable();
            $table->text('contact_us_text')->nullable();
            $table->text('terms_text')->nullable();
            $table->text('activite_terms')->nullable();
            $table->text('counter1_name')->nullable();
            $table->bigInteger('counter1_count')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
