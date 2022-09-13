<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColoumnLevelIdToQualificationTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('qualification_types', function (Blueprint $table) {
            $table->integer('level_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('qualification_types', function (Blueprint $table) {
            $table->dropColumn('level_id');
        });
    }
}
