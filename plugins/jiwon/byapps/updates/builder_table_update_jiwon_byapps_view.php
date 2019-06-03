<?php namespace Jiwon\Byapps\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateJiwonByappsView extends Migration
{
    public function up()
    {
        Schema::table('jiwon_byapps_view', function($table)
        {
            $table->increments('idx')->unsigned(false)->change();
        });
    }
    
    public function down()
    {
        Schema::table('jiwon_byapps_view', function($table)
        {
            $table->increments('idx')->unsigned()->change();
        });
    }
}
