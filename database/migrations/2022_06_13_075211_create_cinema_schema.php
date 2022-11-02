<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCinemaSchema extends Migration
{
    /** ToDo: Create a migration that creates all tables for the following user stories

    For an example on how a UI for an api using this might look like, please try to book a show at https://in.bookmyshow.com/.
    To not introduce additional complexity, please consider only one cinema.

    Please list the tables that you would create including keys, foreign keys and attributes that are required by the user stories.

    ## User Stories

     **Movie exploration**
     * As a user I want to see which films can be watched and at what times
     * As a user I want to only see the shows which are not booked out

     **Show administration**
     * As a cinema owner I want to run different films at different times
     * As a cinema owner I want to run multiple films at the same time in different showrooms

     **Pricing**
     * As a cinema owner I want to get paid differently per show
     * As a cinema owner I want to give different seat types a percentage premium, for example 50 % more for vip seat

     **Seating**
     * As a user I want to book a seat
     * As a user I want to book a vip seat/couple seat/super vip/whatever
     * As a user I want to see which seats are still available
     * As a user I want to know where I'm sitting on my ticket
     * As a cinema owner I dont want to configure the seating for every show
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->timestamps();
        });

        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamps();
        });

        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('max_seat_counts');
            $table->timestamps();
        });


        Schema::create('movie_graphics', function (Blueprint $table) {
            $table->id();
            $table->integer('movie_id')->index();
            $table->datetime('starts');
            $table->datetime('ends');
            $table->timestamps();
        });

        Schema::create('seat_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('percentage_value');
            $table->timestamps();
        });

        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            $table->boolean('available'); //it will show if seat is available or not
            $table->integer('room_id')->index();
            $table->integer('seat_type_id')->index();
            $table->timestamps();
        });

        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->index();
            $table->integer('price');
            $table->integer('seat_id')->index();
            $table->integer('movie_graphic_id')->index();
            $table->timestamps();
        });

//        Schema::table('movie_graphics', function (Blueprint $table) {
//            $table->foreign('movie_id')->references('id')->on('movies')->onUpdate('RESTRICT')->onDelete('CASCADE');
//        });
//
//        Schema::table('seats', function (Blueprint $table) {
//            $table->foreign('room_id')->references('id')->on('rooms')->onUpdate('RESTRICT')->onDelete('CASCADE');
//            $table->foreign('seat_type_id')->references('id')->on('seat_types')->onUpdate('RESTRICT')->onDelete('CASCADE');
//        });
//
//        Schema::table('tickets', function (Blueprint $table) {
//            $table->foreign('customer_id')->references('id')->on('customers')->onUpdate('RESTRICT')->onDelete('CASCADE');
//            $table->foreign('seat_id')->references('id')->on('seats')->onUpdate('RESTRICT')->onDelete('CASCADE');
//            $table->foreign('movie_graphic_id')->references('id')->on('movie_graphics')->onUpdate('RESTRICT')->onDelete('CASCADE');
//        });
//        throw new \Exception('implement in coding task 4, you can ignore this exception if you are just running the initial migrations.');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
        Schema::dropIfExists('movies');
        Schema::dropIfExists('rooms');
        Schema::dropIfExists('movie_graphics');
        Schema::dropIfExists('seat_types');
        Schema::dropIfExists('seats');
        Schema::dropIfExists('tickets');
    }
}
