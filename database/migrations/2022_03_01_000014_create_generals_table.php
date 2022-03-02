<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralsTable extends Migration
{
    public function up()
    {
        Schema::create('generals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mer_reg_id_no')->unique();
            $table->string('mer_pas_key');
            $table->string('ekpay_dev_uri');
            $table->string('ekpay_prod_uri');
            $table->boolean('test_mode')->default(0);
            $table->string('s_uri');
            $table->string('f_uri');
            $table->string('c_uri');
            $table->string('ipn_uri');
            $table->string('mac_addr');
            $table->string('ipn_channel');
            $table->string('ipn_email');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
