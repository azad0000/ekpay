<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIpnsTable extends Migration
{
    public function up()
    {
        Schema::create('ipns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('msg_code');
            $table->longText('msg_det');
            $table->datetime('req_timestamp');
            $table->string('dgtl_sign')->nullable();
            $table->string('remarks')->nullable();
            $table->string('ekpay_txn_id_no')->unique();
            $table->string('pi_trnx_id_no')->nullable();
            $table->string('pi_charge');
            $table->string('ekpay_charge');
            $table->string('pi_discount');
            $table->string('total_ser_charge');
            $table->string('ekpay_charge_discount');
            $table->string('promo_discount');
            $table->string('total_pabl_amt');
            $table->datetime('pay_timestamp');
            $table->string('pi_name')->nullable();
            $table->string('pi_type')->nullable();
            $table->string('pi_number')->nullable();
            $table->string('pi_gateway')->nullable();
            $table->string('is_settled');
            $table->string('settlement')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
