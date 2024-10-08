<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharterJobItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charter_job_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('charter_job_id')->unsigned();
            $table->bigInteger('from_address_id')->unsigned();
            $table->bigInteger('to_address_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->decimal('amount', 8, 2)->default(0.00);
            $table->integer('unit_id')->unsigned();
            $table->decimal('total_weight', 8, 2)->nullable()->default(0.00);
            $table->double('productvalue', 8, 2)->nullable()->default(0.00);
            $table->dateTime('pickup_date')->nullable();
            $table->dateTime('delivery_date')->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('charter_job_items', function (Blueprint $table) {
            $table->unique([
                'charter_job_id',
                'from_address_id',
                'to_address_id',
                'product_id',
                'unit_id'
            ], 'PrimaryCharterJobItems');
            $table->foreign('charter_job_id')
                ->references('id')
                ->on('charter_jobs')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('charter_job_items');
    }
}
