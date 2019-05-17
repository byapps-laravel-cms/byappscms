<?php namespace Jiwon\Byapps\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateJiwonByappsPaymanage extends Migration
{
    public function up()
    {
        Schema::table('jiwon_byapps_paymanage', function($table)
        {
            $table->increments('id')->unsigned(false)->change();
            $table->string('app_name')->change();
            $table->string('period')->change();
        });
    }
    
    public function down()
    {
        Schema::table('jiwon_byapps_paymanage', function($table)
        {
            $table->increments('id')->unsigned()->change();
            $table->string('app_name', 191)->change();
            $table->string('period', 191)->change();
        });
    }
}
