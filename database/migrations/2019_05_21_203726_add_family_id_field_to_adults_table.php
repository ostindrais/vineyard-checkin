<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFamilyIdFieldToAdultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('adults', function (Blueprint $table) {
            $driver = Schema::connection($this->getConnection())->getConnection()->getDriverName();

            if ($driver == 'sqlite') {
                $table->integer('family_id')->unsigned()->after('id')->default(0);
            } else {
                $table->integer('family_id')->unsigned()->after('id');
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
        Schema::table('adults', function (Blueprint $table) {
            $table->dropColumn('family_id');
        });
    }
}
