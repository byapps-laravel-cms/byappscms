<?php namespace Jiwon\Byapps\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateJiwonByappsHomeLayout extends Migration
{
    public function up()
    {
        Schema::table('jiwon_byapps_home_layout', function($table)
        {
            $table->dropColumn('idx');
        });
    }
    
    public function down()
    {
        Schema::table('jiwon_byapps_home_layout', function($table)
        {
            $table->increments('idx')->unsigned();
        });
    }
}
