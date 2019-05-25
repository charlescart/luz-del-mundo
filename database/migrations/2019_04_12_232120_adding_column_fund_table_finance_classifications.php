<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddingColumnFundTableFinanceClassifications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('finance_classifications', function (Blueprint $table) {
            $table->boolean('fund')->after('class')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
            Schema::table('finance_classifications', function (Blueprint $table) {
                if (Schema::hasColumn('finance_classifications', 'fund')) {
                    $table->dropColumn('fund');
                }
        });
    }
}
