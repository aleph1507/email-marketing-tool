<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->dateTime('send_at')->nullable();
            $table->boolean('sent')->default(false);

            $table->boolean('scheduled')->default(false);

            $table->bigInteger('template_id')->unsigned();
            $table->foreign('template_id')
                ->references('id')
                ->on('templates')->onDelete('cascade');

            $table->bigInteger('customer_group_id')->unsigned();
            $table->foreign('customer_group_id')
                ->references('id')
                ->on('customer_groups')->onDelete('cascade');

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
        Schema::dropIfExists('campaigns');
    }
}
