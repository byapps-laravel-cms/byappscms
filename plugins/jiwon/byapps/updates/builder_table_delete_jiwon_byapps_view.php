<?php namespace Jiwon\Byapps\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableDeleteJiwonByappsView extends Migration
{
    public function up()
    {
        Schema::dropIfExists('jiwon_byapps_view');
    }
    
    public function down()
    {
        Schema::create('jiwon_byapps_view', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('idx');
        });
    }
}
