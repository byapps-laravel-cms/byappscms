<?php namespace Jiwon\Byapps\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateJiwonByappsPaymanage4 extends Migration
{
    public function up()
    {
        Schema::table('jiwon_byapps_paymanage', function($table)
        {
            $table->string('period', 191)->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('jiwon_byapps_paymanage', function($table)
        {
            $table->string('period', 191)->nullable(false)->change();
        });
    }
}
