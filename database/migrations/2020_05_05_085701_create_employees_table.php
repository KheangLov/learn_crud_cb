<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('name_khmer')->nullable();
            $table->string('gender');
            $table->string('email')->unique();
            $table->string('password');
            $table->date('dob');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->decimal('annual_leave', 8, 2)->nullable();
            $table->text('id_card')->nullable();
            $table->string('bank_account')->nullable();
            $table->decimal('salary', 10, 2)->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->text('contact')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('contact_relation')->nullable();
            $table->string('contact_phone')->nullable();
            $table->text('contract')->nullable();
            $table->text('profile')->nullable();
            $table->string('hobby')->nullable();
            $table->string('home_town')->nullable();
            $table->string('self_intro')->nullable();
            $table->string('goal')->nullable();
            $table->string('education')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->integer('supervisor_id')->unsigned()->nullable();
            $table->foreign('supervisor_id')->references('id')->on('cms_users');
            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->unsignedBigInteger('unit_id');
            $table->foreign('unit_id')->references('id')->on('units');
            $table->unsignedBigInteger('position_id');
            $table->foreign('position_id')->references('id')->on('positions');
            $table->unsignedBigInteger('group_id');
            $table->foreign('group_id')->references('id')->on('groups');
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
        Schema::dropIfExists('employees');
    }
}
