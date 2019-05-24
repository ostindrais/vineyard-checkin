<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToChildrenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('children', function (Blueprint $table) {
            $driver = Schema::connection($this->getConnection())->getConnection()->getDriverName();

            if ($driver == 'sqlite') {
                $table->unsignedBigInteger('family_id')->nullable();
                $table->foreign('family_id')->references('id')->on('families');
                $table->string('lastname', 50)->nullable();
                $table->string('firstname', 50)->nullable();
                $table->date('dob')->nullable();
            } else {
                $table->unsignedBigInteger('family_id');
                $table->foreign('family_id')->references('id')->on('families');
                $table->string('lastname', 50);
                $table->string('firstname', 50);
                $table->date('dob');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('children', function (Blueprint $table) {
            $table->dropColumn('family_id');
            $table->dropColumn('lastname');
            $table->dropColumn('firstname');
            $table->dropColumn('dob');
        });
    }
}
