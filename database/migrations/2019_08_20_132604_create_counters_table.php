<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Counter;

class CreateCountersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key')->unique();
            $table->string('prefix');
            $table->string('value');
            $table->integer('user_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Counter::create([
            'key' => 'tranjob',
            'prefix' => 'JOB-',
            'value' => 10000
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('counters');
    }
}
