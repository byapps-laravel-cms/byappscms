<?php namespace Jiwon\Byapps\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateJiwonByappsHomeLayout3 extends Migration
{
    public function up()
    {
        Schema::table('jiwon_byapps_home_layout', function($table)
        {
            $table->primary(['user_cd','layout_name']);
        });
    }
    
    public function down()
    {
        Schema::table('jiwon_byapps_home_layout', function($table)
        {
            $table->dropPrimary(['user_cd','layout_name']);
        });
    }
}
