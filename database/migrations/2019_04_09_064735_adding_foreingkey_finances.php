<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddingForeingkeyFinances extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('finances', function (Blueprint $table) {
            $table->unsignedInteger('currency_id')->after('finance_classification_id');
            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('finances', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
            if (Schema::hasColumn('finances', 'currency_id')) {
                $table->dropColumn('currency_id');
            }
        });
    }
}
