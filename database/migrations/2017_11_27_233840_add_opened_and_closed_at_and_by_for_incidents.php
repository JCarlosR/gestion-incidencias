<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOpenedAndClosedAtAndByForIncidents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('incidents', function (Blueprint $table) {
            $table->dateTime('opened_at')->nullable();
            $table->dateTime('closed_at')->nullable();

            $table->integer('opened_by')->unsigned()->nullable();
            $table->integer('closed_by')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('incidents', function($table) {
            $table->dropColumn([
                'opened_at', 'closed_at',
                'opened_by', 'closed_by'
            ]);
        });
    }
}
