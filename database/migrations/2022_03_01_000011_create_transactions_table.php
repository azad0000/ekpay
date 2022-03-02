<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cust_id_no')->unique();
            $table->string('cust_name');
            $table->string('cust_mobo_no');
            $table->string('cust_email')->nullable();
            $table->string('cust_mail_addr')->nullable();
            $table->string('merchant_trnx_id_no')->unique();
            $table->string('merchant_trnx_amt');
            $table->string('trnx_currency');
            $table->string('merchant_ord_id_no')->nullable();
            $table->longText('merchant_ord_det')->nullable();
            $table->string('payment_url')->nullable();
            $table->string('secure_token')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
