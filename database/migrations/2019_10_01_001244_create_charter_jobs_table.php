<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharterJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charter_jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('status', ['New', 'Confirmed', 'Cancel'])->default('New');
            $table->char('job_no', 20);
            $table->dateTime('job_date');
            $table->integer('branch_id')->unsigned();
            $table->bigInteger('customer_id')->unsigned();
            $table->enum('paymenttype', ['เงินสด', 'วางบิล'])->default('เงินสด');
            $table->enum('paymentpoint', ['จุดรับสินค้าต้นทาง', 'จุดส่งสินค้าปลายทาง'])->default('จุดรับสินค้าต้นทาง');
            $table->integer('user_id')->unsigned();
            $table->string('terms', 150)->nullable();
            $table->string('reference', 20)->nullable();
            $table->bigInteger('quotation_id')->nullable();
            $table->bigInteger('employee_id')->unsigned();
            $table->bigInteger('charter_price_id')->unsigned();
            $table->double('sub_total')->default(0);
            $table->double('discount')->default(0);
            $table->double('tax_amount')->default(0);
            $table->double('total')->default(0);
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();
        });
        Schema::table('charter_jobs', function (Blueprint $table) {
            $table->unique([
                'job_no',
            ], 'PrimaryCharterJobs');
            $table->foreign('customer_id')
                ->references('id')
                ->on('customers')
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
        Schema::dropIfExists('charter_jobs');
    }
}
