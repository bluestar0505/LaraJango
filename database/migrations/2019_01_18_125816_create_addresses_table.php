<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id')->unsigned();;
            $table->integer('house');
            $table->string('street');
            $table->string('quarter');
            $table->string('city');
            $table->string('region');
            $table->string('country');
            $table->string('description');
            $table->string('w3w')->unique()->index();
            $table->string('lat');
            $table->string('long');
            $table->string('full');
            $table->boolean('activated')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
