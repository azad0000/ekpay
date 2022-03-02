<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettlementTransactionPivotTable extends Migration
{
    public function up()
    {
        Schema::create('settlement_transaction', function (Blueprint $table) {
            $table->unsignedBigInteger('settlement_id');
            $table->foreign('settlement_id', 'settlement_id_fk_6110225')->references('id')->on('settlements')->onDelete('cascade');
            $table->unsignedBigInteger('transaction_id');
            $table->foreign('transaction_id', 'transaction_id_fk_6110225')->references('id')->on('transactions')->onDelete('cascade');
        });
    }
}
