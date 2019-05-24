<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToCheckins extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('checkins', function (Blueprint $table) {
            $driver = Schema::connection($this->getConnection())->getConnection()->getDriverName();

            if ($driver == 'sqlite') {
                $table->unsignedBigInteger('event_id')->nullable();
                $table->unsignedBigInteger('child_id')->nullable();
                $table->enum('type', ['kids', 'tykes'])->default('kids');
            } else {
                $table->unsignedBigInteger('event_id');
                $table->unsignedBigInteger('child_id');
                $table->enum('type', ['kids', 'tykes'])->default('kids');
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
        Schema::table('checkins', function (Blueprint $table) {
            $table->dropColumn('event_id');
            $table->dropColumn('child_id');
            $table->dropColumn('type');
        });
    }
}
