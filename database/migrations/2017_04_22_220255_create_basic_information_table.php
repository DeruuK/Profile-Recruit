<?php
Schema::defaultStringLength(191);
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateBasicInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('basic_information', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->enum('gender', array('male', 'female'));
            $table->string('major');
            $table->string('educationDegree');
            $table->enum('status', array('full-time', 'new-graduate','recruiter'));
            $table->string('url');
            $table->rememberToken();
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
        //
        Schema::dropIfExists('basic_information');
    }
}
