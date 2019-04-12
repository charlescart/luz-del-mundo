<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddingColumnClassTableFinanceClassifications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('finance_classifications', function (Blueprint $table) {
            $table->string('class', 100)->nullable()->after('color');
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
            if (Schema::hasColumn('finance_classifications', 'class')) {
                Schema::disableForeignKeyConstraints();
                $table->dropColumn('class');
            }
        });
    }
}
