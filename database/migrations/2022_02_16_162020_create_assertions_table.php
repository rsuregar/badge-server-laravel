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
        Schema::create('assertions', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->string('entity_id')->unique();
            $table->foreignUuid('badge_class_uuid');
            $table->string('image');
            $table->enum('recipient_type', ['email', 'url', 'telephone'])->default('email');
            $table->string('recipient_identifier')->nullable();
            $table->string('recipient_name')->nullable();
            $table->string('recipient_email');
            $table->timestamp('issued_on')->nullable()->default(NULL);
            $table->timestamp('expires_on')->nullable()->default(NULL);
            $table->enum('verification_type', ['HostedBadge', 'SignedBadge'])->nullable()->default('HostedBadge');
            $table->softDeletes();

            $table->foreign('badge_class_uuid')->references('uuid')->on('badge_classes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assertions');
    }
};
