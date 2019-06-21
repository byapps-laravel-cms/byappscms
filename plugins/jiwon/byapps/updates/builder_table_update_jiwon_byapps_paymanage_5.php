<?php namespace Jiwon\Byapps\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateJiwonByappsPaymanage5 extends Migration
{
    public function up()
    {
        Schema::table('jiwon_byapps_paymanage', function($table)
        {
            $table->text('pay_amount')->nullable(false)->unsigned(false)->default(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('jiwon_byapps_paymanage', function($table)
        {
            $table->decimal('pay_amount', 10, 0)->nullable(false)->unsigned(false)->default(null)->change();
        });
    }
}
