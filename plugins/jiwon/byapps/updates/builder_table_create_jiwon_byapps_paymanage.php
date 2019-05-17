<?php namespace Jiwon\Byapps\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateJiwonByappsPaymanage extends Migration
{
    public function up()
    {
        Schema::create('jiwon_byapps_paymanage', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('app_name');
            $table->integer('is_new');
            $table->string('period');
            $table->integer('recipe');
            $table->decimal('payment', 10, 0);
            $table->dateTime('pay_date');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('jiwon_byapps_paymanage');
    }
}
