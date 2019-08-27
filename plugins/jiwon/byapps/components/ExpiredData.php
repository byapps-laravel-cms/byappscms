<?php namespace Jiwon\Byapps\Components;

use Cms\Classes\ComponentBase;
use Jiwon\Byapps\Models\AppsData;

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
    public function getExpiredApps()
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
    public function getWillBeExpiredApps()
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

    public function onRun()
    {
      $this->page['expiredApps'] = $this->getExpiredApps();
      $this->page['willBeExpiredApps'] = $this->getWillBeExpiredApps();
      $this->page['expiredPush'] = $this->getExpiredPush();
      $this->page['willBeExpiredPush'] = $this->getWillBeExpiredPush();
    }
}
