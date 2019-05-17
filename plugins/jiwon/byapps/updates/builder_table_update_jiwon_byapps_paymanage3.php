<?php namespace Jiwon\Byapps\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateJiwonByappsPaymanage3 extends Migration
{
    public function up()
    {
        Schema::table('jiwon_byapps_paymanage', function($table)
        {
            $table->date('start_date');
            $table->date('end_date');
            $table->renameColumn('payment', 'pay_amount');
        });
    }
    
    public function down()
    {
        Schema::table('jiwon_byapps_paymanage', function($table)
        {
            $table->dropColumn('start_date');
            $table->dropColumn('end_date');
            $table->renameColumn('pay_amount', 'payment');
        });
    }
}