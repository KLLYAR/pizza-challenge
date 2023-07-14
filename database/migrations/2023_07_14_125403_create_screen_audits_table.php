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
        Schema::create('screen_audits', function (Blueprint $table) {
            $table->id();
            $table->string('screenshot_path');
            $table->bigInteger('deptor_id');
            $table->bigInteger('admin_id');
            $table->boolean('hasRefri')->default(false);
            $table->timestamp('payed_at')->nullable();
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
        Schema::dropIfExists('screen_audits');
    }
};
