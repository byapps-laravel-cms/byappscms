<?php namespace Jiwon\Byapps\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateJiwonByappsPaymanage3 extends Migration
{
    public function up()
    {
        Schema::table('jiwon_byapps_paymanage', function($table)
        {
            $table->text('order_number');
            $table->text('user_id');
        });
    }
    
    public function down()
    {
        Schema::table('jiwon_byapps_paymanage', function($table)
        {
            $table->dropColumn('order_number');
            $table->dropColumn('user_id');
        });
    }
}
