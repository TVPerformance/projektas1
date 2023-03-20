<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->date('start');
            $table->date('end');
        });
    }
    // Schema::create('customers', function (Blueprint $table) {
    //     $table->id();
    //     $table->string('name', 100);
    //     $table->string('surname', 100);
    //     $table->unsignedBigInteger('pers_id');
    //     $table->string('account', 100);
    //     $table->decimal('balance', 8, 2)->unsigned();
    //     $table->timestamps();
    // });
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
};
