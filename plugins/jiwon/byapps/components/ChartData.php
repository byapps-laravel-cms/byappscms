<?php namespace Jiwon\Byapps\Components;

use Db;

use Cms\Classes\ComponentBase;

use Jiwon\Byapps\Models\AppsData;
use Jiwon\Byapps\Models\MaData;
use Jiwon\Byapps\Models\PaymentData;


class ChartData extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'ChartData Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    // 앱 통계
    public function onGetAppChartData()
    {
      // 전체
      // original query: select count(*) from BYAPPS_apps_data where app_process='7' and ( service_type='lite' or ((end_time-".time().")/86400)>'0' )
      // select count(*) from BYAPPS_apps_data where app_process='7' and ( service_type='lite' or (end_time-unix_timestamp())>'0' )
      // select count(*) from BYAPPS_apps_data where app_process='7' and ( service_type='lite' or (end_time > unix_timestamp()))
      $appsTotal = AppsData::where('app_process', '=', '7')
                    ->where(function($query){
                      $query->where('service_type', '=', 'lite')->orWhere('end_time', '>', time());
                    })
                    ->count();

      // 유료
      // original query: select count(*) from (select order_id from BYAPPS_apps_data where app_process='7' and ( service_type='lite' or ((end_time-".time().")/86400)>'0') ) a
      //                 inner join (select order_id from BYAPPS_apps_payment_data where process='1' and amount>'0' group by order_id) b on a.order_id=b.order_id
      // 연장(pay_type = 1), 신규, 결제금액이 있는 경우, 서비스유효

      $appsPaid = Db::table('marutm1.BYAPPS_apps_data as A')
                  ->leftJoin('marutm1.BYAPPS_apps_payment_data as B', 'A.order_id', '=', 'B.order_id')
                  ->where('A.app_process', '=', '7')
                  //->selectRaw("'A.service_type' = 'lite' or 'A.end_time' > unix_timestamp()")
                  ->where(function($query){
                    $query->where('A.service_type', '=', 'lite')->orWhere('A.end_time', '>', time());
                  })
                  ->where('B.process', '=', '1')
                  ->where('B.amount', '>', '0')
                  ->distinct()
                  ->count('A.order_id');

      // 무료
      // 결제금액이 없는 경우, 관리업체가 아닌 경우(is_cherrypicker != Y), 서비스유효
      $appsFree = $appsTotal - $appsPaid;

      // 관리
      // original query: 없음
      // 관리업체에 체크(is_cherrypicker = Y), 서비스유효
      $appsCheck = 100;

      $result = array(
          'circle1' => array(
              array('무료', $appsFree),
              array('유료', $appsPaid),
              array('관리', $appsCheck),
          )
      );

      return $result;
    }

    function onGetAppDailyChartData()
    {
      $result = array(
          'circle1' => array(
              array('무료', 300),
              array('유료', 200),
              array('관리', 100),
          )
      );

      return $result;
    }


    // MA 통계
    function onGetMaChartData()
    {
      // 전체
      // original query: select count(*) from BYAPPS_MA_data where app_process='3' and ((end_time-".time().")/86400)>'0'";
      $maTotal = MaData::where('app_process', '=', '3')
                  ->where('end_time', '>', time())
                  ->count();

      // 유료
      // original query: select count(*) from (select order_id from BYAPPS_MA_data where app_process='3' and ((end_time-".time().")/86400)>'0') a
      //                 inner join (select order_id from BYAPPS_apps_payment_data where process='1' and amount>'0' group by order_id) b on a.order_id=b.order_id
      // select count(*) from (select order_id from BYAPPS_MA_data where app_process='3' and ((end_time-unix_timestamp())/86400)>'0') a inner join (select order_id from BYAPPS_apps_payment_data where process='1' and amount>'0' group by order_id) b on a.order_id=b.order_id

      $maPaid = Db::table('marutm1.BYAPPS_MA_data as A')
                ->leftJoin('marutm1.BYAPPS_apps_payment_data as B', 'A.order_id', '=', 'B.order_id')
                ->where('A.app_process', '=', '3')
                ->where('A.end_time', '>', time())
                ->where('B.process', '=', '1')
                ->where('B.amount', '>', '0')
                ->distinct()
                ->count('A.order_id');

      // 무료
      $maFree = $maTotal - $maPaid;

      // 관리
      // original query: 없음
      $maCheck = 10;

      $result = array(
        'circle2' => array(
            array('무료', $maFree),
            array('유료', $maPaid),
            array('관리', $maCheck),
        )
      );

      return $result;
    }

    function onGetMaDailyChartData()
    {
      $result = array(
        'circle2' => array(
            array('무료', 180),
            array('유료', 270),
            array('관리', 100),
        )
      );

      return $result;
    }

    // 매출 통계
    function onGetSalesChartData()
    {
      // 전체
      // origianl query: SELECT sum(amount) as total, sum(case when pay_type='0' then amount end) as newt, sum(case when pay_type='1' then amount end) as con
      //                 FROM BYAPPS_apps_payment_data where process=1 and (reg_time between '".get_mktime(date("Y-m")."-01-0-0-0")."' and '".get_mktime(date("Y-m")."-31-23-59-59")."')
      //                 order by idx asc
      // SELECT sum(amount) as total, sum(case when pay_type='0' then amount end) as newt, sum(case when pay_type='1' then amount end) as con
      // FROM BYAPPS_apps_payment_data where process=1 and (reg_time between unix_timestamp('2019-03-01 00:00:00') and unix_timestamp('2019-03-31 23:59:59')) order by idx asc

      $from = mktime(0, 0, 0, date("03"), 01, date("Y"));
      $to = mktime(23, 59, 59, date("03"), 31, date("Y"));

      $salesTotal = PaymentData::where('process', '=', '1')
                    ->whereBetween('reg_time', [$from, $to])
                    ->orderBy('idx', 'asc')
                    ->sum('amount');

      // 신규
      $salesNew = PaymentData::where('process', '=', '1')
                  ->whereBetween('reg_time', [$from, $to])
                  ->orderBy('idx', 'asc')
                  ->sum(DB::Raw("case when pay_type='0' then amount end"));

      // 연장
      $salesCon = PaymentData::where('process', '=', '1')
                  ->whereBetween('reg_time', [$from, $to])
                  ->orderBy('idx', 'asc')
                  ->sum(DB::Raw("case when pay_type='1' then amount end"));

      $salesEtc = $salesTotal - ($salesNew + $salesCon);

      $result = array(
        'bar' => array(
            array('전체', $salesTotal),
            array('신규', $salesNew),
            array('연장', $salesCon),
            array('기타', $salesEtc),
        )
      );

      return $result;
    }

}
