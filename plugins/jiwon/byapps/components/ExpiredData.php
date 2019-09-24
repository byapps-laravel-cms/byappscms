<?php namespace Jiwon\Byapps\Components;

use Cms\Classes\ComponentBase;
use Jiwon\Byapps\Models\AppsData;
use Jiwon\Byapps\Models\MaData;

class ExpiredData extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'ExpiredData Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    // iOS 계정 만료된 업체들
    public function getExpiredIos()
    {
      // original query: select app_id,app_name,ios_dev_exp from BYAPPS_apps_data where ios_dev_exp!='' and ios_dev_exp<'".$next_month."' order by ios_dev_exp
    	$todate=date("Y-m-d");

      return AppsData::select('app_name', 'app_id', 'ios_dev_exp')
              ->where('ios_dev_exp', '!=', '')
              ->where('ios_dev_exp', '<', $todate)
              ->orderBy('ios_dev_exp')
              ->get();
    }

    // iOS 계정 만료예정 업체들
    public function getWillBeExpiredIos()
    {
      $next_month=date("Y-m-d",strtotime("now +30 day"));
      $todate=date("Y-m-d",strtotime("now +1 day"));

      return AppsData::select('app_name', 'app_id', 'ios_dev_exp')
                        ->where('ios_dev_exp', '!=', '')
                        ->whereBetween('ios_dev_exp', [$todate, $next_month])
                        ->orderBy('ios_dev_exp')
                        ->get();
    }

    // push 인증서 만료된 업체들
    public function getExpiredPush()
    {
      // push 인증서 만료
      // original query: select app_id,app_name,ios_cer_exp from BYAPPS_apps_data where ios_cer_exp!='' and ios_cer_exp<'".$next_month."' order by ios_cer_exp
    	$todate=date("Y-m-d");

      return AppsData::select('app_name', 'app_id', 'ios_cer_exp')
              ->where('ios_cer_exp', '!=', '')
              ->where('ios_cer_exp', '<', $todate)
              ->orderBy('ios_cer_exp')
              ->get();
    }

    // push 인증서 만료예정 업체들
    public function getWillBeExpiredPush()
    {
      $next_month=date("Y-m-d",strtotime("now +20 day"));
    	$todate=date("Y-m-d");

      return AppsData::select('app_name', 'app_id', 'ios_cer_exp')
              ->where('ios_cer_exp', '!=', '')
              ->whereBetween('ios_cer_exp', [$todate, $next_month])
              ->orderBy('ios_cer_exp')
              ->get();
    }

    // MA 서비스 만료된 업체들
    public function getExpiredMA()
    {
      // MA 서비스 만료
      // original query: S$next_month=time()+(86400*20);
    	//$qry="select ma_id,app_name,end_time from BYAPPS_MA_data where app_process='3' and end_time>0 and end_time<'".$next_month."' order by end_time";
      $todate=time();
    	$next_month=time()+(86400*20);

      return MaData::select('ma_id', 'app_name', 'end_time')
              ->where('app_process', '=', '3')
              ->where('end_time', '>', 0)
              ->where('end_time', '<', $todate)
              ->orderBy('end_time')
              ->get();
    }

    // MA 서비스 만료예정 업체들
    public function getWillBeExpiredMA()
    {
      $todate=time()+(86400*1);
    	$next_month=time()+(86400*30);

      return MaData::select('ma_id', 'app_name', 'end_time')
              ->where('app_process', '=', '3')
              ->where('end_time', '>', 0)
              ->whereBetween('end_time', [$todate, $next_month])
              ->orderBy('end_time')
              ->get();
    }

    // 앱서비스 만료된 업체들
    public function getExpiredApps()
    {
      // original query: 없음
    	$todate=time();

      return AppsData::select('app_name', 'app_id', 'end_time')
                        ->where('app_process', '=', '7')
                        ->where('end_time', '!=', '0')
                        ->where('end_time', '<', $todate)
                        ->orderBy('end_time')
                        ->get();
    }

    // 앱서비스 만료예정 업체들
    public function getWillBeExpiredApps()
    {
      $todate=time()+(86400*1);
    	$next_month=time()+(86400*30);

      return AppsData::select('app_name', 'app_id', 'end_time')
                          ->where('app_process', '=', '7')
                          ->where('end_time', '!=', '0')
                          ->whereBetween('end_time', [$todate, $next_month])
                          ->orderBy('end_time')
                          ->get();
    }

    public function onRun()
    {
      $this->page['expiredIos'] = $this->getExpiredIos();
      $this->page['willBeExpiredIos'] = $this->getWillBeExpiredIos();
      $this->page['expiredPush'] = $this->getExpiredPush();
      $this->page['willBeExpiredPush'] = $this->getWillBeExpiredPush();
      $this->page['expiredMA'] = $this->getExpiredMA();
      $this->page['willBeExpiredMA'] = $this->getWillBeExpiredMA();
      $this->page['expiredApps'] = $this->getExpiredApps();
      $this->page['willBeExpiredApps'] = $this->getWillBeExpiredApps();
    }
}
