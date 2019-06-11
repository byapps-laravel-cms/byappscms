<?php namespace Jiwon\Byapps\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateJiwonByappsHomeLayout2 extends Migration
{
    public function up()
    {
        Schema::table('jiwon_byapps_home_layout', function($table)
        {
            $table->string('layout_name', 10)->nullable(false)->unsigned(false)->default(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('jiwon_byapps_home_layout', function($table)
        {
            $table->integer('layout_name')->nullable(false)->unsigned(false)->default(null)->change();
        });
    }
}
