<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateVisitorInformationModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitor_information', function (Blueprint $table) {
            $table->id();
            $table->text("vis_ip");
            $table->text("vis_city")->nullable();
            $table->text("vis_country")->nullable();
            $table->text("vis_countrycode")->nullable();
            $table->text("vis_os")->nullable();
            $table->text("vis_browser")->nullable();
            $table->text("vis_longitude")->nullable();
            $table->text("vis_latitude")->nullable();
            $table->timestamp("vis_lastvisit")->default(DB::raw('CURRENT_TIMESTAMP'));;
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
        Schema::dropIfExists('visitor_information');
    }
}
