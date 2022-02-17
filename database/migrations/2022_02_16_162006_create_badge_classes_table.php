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
    public function up()
    {
        Schema::create('badge_classes', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->string('entity_id')->unique();
            $table->uuid('issuer_uuid');
            $table->string('name');
            $table->text('description');
            $table->string('image');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('issuer_uuid')->references('uuid')->on('issuers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('badge_classes');
    }
};
