<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $driver = Schema::connection($this->getConnection())->getConnection()->getDriverName();

            if ($driver == 'sqlite') {
                $table->string('name', 100)->nullable()->after('id');
                $table->dateTime('start_time')->after('name')->nullable();
                $table->dateTime('end_time')->after('start_time')->nullable();
            } else {
                $table->string('name', 100)->nullable()->after('id');
                $table->dateTime('start_time')->after('name');
                $table->dateTime('end_time')->after('start_time')->nullable();
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
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('start_time');
            $table->dropColumn('end_time');
        });
    }
}
