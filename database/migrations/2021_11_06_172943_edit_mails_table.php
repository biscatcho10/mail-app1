<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mails', function (Blueprint $table) {
            $table->boolean('scheduled')->nullable();
            $table->boolean('is_sent')->default(0);
            $table->timestamp('sent_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mails', function (Blueprint $table) {
            $table->dropColumn('scheduled');
            $table->dropColumn('sent_time');
        });
    }
}
