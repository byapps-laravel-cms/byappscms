<?php namespace Jiwon\Byapps\Components;

use Cms\Classes\ComponentBase;
use Exception;
use Yajra\Datatables\Datatables;
use Jiwon\Byapps\Models\PaymentData;

class Datatable extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'Datatable Component',
            'description' => 'Datatable을 위한 컴포넌트'
        ];
    }

    public function defineProperties()
    {
        return [
          'tableName' => [
              'title' => '대상 테이블',
              'description' => '대상 테이블',
              'type'        => 'dropdown',
              'default'     => 'paymanageTable'
          ]
        ];
    }

    // public function getTableNameOptions() {
    //     return [
    //       'paymanageTable' => '결제관리',
    //       'promotionTable'=> '프로모션',
    //       'updateTable' => '업데이트 관리',
    //       'appsListTable' => '앱 목록',
    //     ];
    // }

    public function onRun()
    {
       // $tableName = $this->property('tableName');
       // $this->page['tableName'] = $tableName;
       
       // $this->getIndex();
       // $this->anyData();
    }

    public function anyData()
    {
        return Datatables::of(PaymentData::query())->make(true);
    }

    public function getIndex()
   {
       //return 'default';
       $paymentData = PaymentData::select('idx', 'app_name', 'pay_type', 'term', 'amount', 'reg_time');


       return Datatables::of($paymentData)->make(true);
   }

}
?>
