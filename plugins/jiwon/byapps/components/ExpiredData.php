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


    public function getExpiredApps()
    {
      // iOS 계정만료 예정업체
      // original query: select app_id,app_name,ios_dev_exp from BYAPPS_apps_data where ios_dev_exp!='' and ios_dev_exp<'".$next_month."' order by ios_dev_exp
      //  select app_id,app_name,ios_dev_exp from BYAPPS_apps_data where ios_dev_exp!='' and ios_dev_exp < '2019-08-01' order by ios_dev_exp
      $next_month=date("Y-m-d",strtotime("now +30 day"));

      return AppsData::select('app_name', 'app_id', 'ios_dev_exp')
                          ->where('ios_dev_exp', '!=', '')
                          ->where('ios_dev_exp', '<', $next_month)
                          ->orderBy('ios_dev_exp')
                          ->get();

    }

    public function onRun()
    {
      $this->page['appsData'] = $this->getExpiredApps();
    }
}
