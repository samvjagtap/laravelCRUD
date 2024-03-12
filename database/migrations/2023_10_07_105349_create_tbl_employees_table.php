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
        Schema::create('tbl_employees', function (Blueprint $table) {
            $table->id('emp_id');
            $table->string('fname', 20);
            $table->string('lname', 20);
            $table->string('designation', 40);
            $table->integer('age');
            $table->string('email', 50)->nullable()->unique();
            $table->string('address', 100);
            $table->string('phone')->unique();
            $table->string('password', 50)->unique();
            $table->float('salary');
            $table->unsignedBigInteger('city');
            $table->foreign('city')
                    ->references('city_id')
                    ->on('tbl_citys')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
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
        Schema::dropIfExists('tbl_employees');
    }
};
