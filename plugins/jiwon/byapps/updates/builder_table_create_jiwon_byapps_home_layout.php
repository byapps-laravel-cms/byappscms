<?php namespace Jiwon\Byapps\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateJiwonByappsHomeLayout extends Migration
{
    public function up()
    {
        Schema::create('jiwon_byapps_home_layout', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('idx');
            $table->integer('user_cd');
            $table->integer('sequence');
            $table->integer('layout_name');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('jiwon_byapps_home_layout');
    }
}
