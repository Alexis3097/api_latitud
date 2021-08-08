<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
           $table->foreignId('user_id')->constrained();
            $table->foreignId('expense_type_id')->constrained('expense_types');
            $table->foreignId('check_type_id')->constrained('check_types');
            $table->string('concept');
            $table->double('amount');
            $table->string('photo');
            $table->string('photoId');
            $table->string('Store');
            $table->string('RFC');
            $table->dateTime('date', 0);
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
        Schema::dropIfExists('vouchers');
    }
}
