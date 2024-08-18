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
        Schema::create('mailings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('companies');
            $table->string('description');
            $table->json('config');
            $table->smallInteger('status_load')->default(0);
            $table->smallInteger('status_wipe')->default(0);
            $table->string('filename');
            $table->boolean('setup');
            $table->integer('error');
            $table->json('fields');
            $table->smallInteger('classification')->default(0);
            $table->smallInteger('export_type')->default(0);
            $table->integer('webhook')->default(0);
            $table->boolean('webhook_send')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mailings');
    }
};
