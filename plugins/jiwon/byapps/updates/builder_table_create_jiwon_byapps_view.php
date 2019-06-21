<?php namespace Jiwon\Byapps\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateJiwonByappsView extends Migration
{
    public function up()
    {
        Schema::create('jiwon_byapps_view', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('idx');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('jiwon_byapps_view');
    }
}
