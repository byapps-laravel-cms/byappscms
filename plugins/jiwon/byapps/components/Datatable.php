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
              'default'     => 'paymentTable'
          ]
        ];
    }

    // public function getTableNameOptions() {
    //     return [
    //       'paymentTable' => '결제관리',
    //       'promotionTable'=> '프로모션',
    //       'updateTable' => '업데이트 관리',
    //       'appsListTable' => '앱 목록',
    //     ];
    // }

    public function onRun()
    {
       // $tableName = $this->property('tableName');
       // $this->page['tableName'] = $tableName;
    }

    public function getPaymentData()
   {
       $paymentData = PaymentData::select('idx', 'app_name', 'pay_type', 'term', 'amount', 'reg_time');

       return Datatables::of($paymentData)
              // ->setRowClass(function ($paymentData) {
              //   return $paymentData->idx % 2 == 0 ? 'alert-success' : 'alert-warning';
              // })
              ->setRowId(function($paymentData) {
                return $paymentData->idx;
              })
              ->editColumn('pay_type', '{{ $pay_type == 1 ? "연장" : "신규" }}')
              ->editColumn('amount', '{{ number_format($amount)." 원" }}')
              ->editColumn('term', '{{ $term." 일" }} <button class="btn btn-xs btn-info">기간연장</button>')
              ->rawColumns([ 'term' ])
              ->editColumn('reg_time', '{{ date("Y-m-d", $reg_time) }}')
              ->orderColumn('reg_time', 'reg_time $1')
              ->make(true);
   }

    // public function getMultiFilterSearchData()
    // {
    //     $paymentData = PaymentData::select(['idx', 'app_name', 'pay_type', 'term', 'amount', 'reg_time']);
    //
    //     return Datatables::eloquent($paymentData)
    //             ->filterColumn('app_name', function($query, $keyword) {
    //               $sql = " like ?";
    //               $query->whereRaw($sql, ["%{$keyword}%"]);
    //             })
    //             ->toJson();
    // }

    // public function getEditTermData($newTerm)
    // {
    //     $paymentData = PaymentData::select(['idx', 'app_name', 'pay_type', 'term', 'amount', 'reg_time']);
    //
    //     return Datatables::of($paymentData)
    //             ->editcolumn('term', function($paymentData, $newTerm) {
    //                return $paymentData->newTerm;
    //             })
    //             ->toJson();
    // }


}
?>
