<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToIpnsTable extends Migration
{
    public function up()
    {
        Schema::table('ipns', function (Blueprint $table) {
            $table->unsignedBigInteger('txn_id_no_id')->nullable();
            $table->foreign('txn_id_no_id', 'txn_id_no_fk_6110082')->references('id')->on('transactions');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_6110104')->references('id')->on('teams');
        });
    }
}
