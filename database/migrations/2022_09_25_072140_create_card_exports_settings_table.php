<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardExportsSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_exports_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('acadimic_year_id')->nullable();
            $table->integer('term_id')->nullable();
            $table->integer('value');
            $table->integer('level_id')->nullable();
            $table->enum('case_constrain_id',[2 , 3])->nullable();
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
        Schema::dropIfExists('card_exports_settings');
    }
}
