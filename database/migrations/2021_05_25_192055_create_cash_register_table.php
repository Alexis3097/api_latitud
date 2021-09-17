<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashRegisterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_register', function (Blueprint $table) {
            $table->id();
            $table->double('account');
            $table->string('type');//para amoount = aprobado, para voucher = en revision o aprobado
            $table->unsignedBigInteger('registrable_id');
            $table->string('registrable_type');
            $table->unsignedBigInteger('idDestination');//destino del dinero
            $table->bigInteger('user_id');
            $table->foreign('idDestination')->references('id')->on('users');
            $table->softDeletes();
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
        Schema::dropIfExists('cash_register');
    }
}
