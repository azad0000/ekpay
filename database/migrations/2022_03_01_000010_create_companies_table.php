<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('shortname')->unique();
            $table->boolean('has_ekpay_id_no')->default(0)->nullable();
            $table->string('mer_reg')->nullable();
            $table->string('mer_pas_key')->nullable();
            $table->string('domain_url')->nullable();
            $table->string('s_uri')->nullable();
            $table->string('f_uri')->nullable();
            $table->string('c_uri')->nullable();
            $table->string('ipn_channel');
            $table->string('ipn_email')->unique();
            $table->string('ipn_uri')->nullable();
            $table->string('mac_addr')->nullable();
            $table->boolean('active')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
