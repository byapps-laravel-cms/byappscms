<?php namespace Jiwon\Byapps;

use Lang;
use Backend;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            'Jiwon\Byapps\Components\PaymentForm'         => 'paymentForm',
            'Jiwon\Byapps\Components\PromotionForm'       => 'promotionForm',
            'Jiwon\Byapps\Components\Badge'               => 'badge',
            'Jiwon\Byapps\Components\Comments'            => 'comments',
            'Jiwon\Byapps\Components\Datatable'            => 'datatable',
            'Jiwon\Byapps\Components\ChartData'            => 'chartData',
            'Jiwon\Byapps\Components\ExpiredData'            => 'expiredData',
            //'RainLab\Builder\Components\RecordDetails'    => 'builderDetails'
        ];
    }

    public function registerSettings()
    {
    }

    public function boot()
    {
      $this->search1();
      $this->search2();
    }

    public function search1()
    {
        \Event::listen('offline.sitesearch.query', function ($query) {
    info('searching search1');

            // Search your plugin's contents
            $items1 = Models\AppsData::where('app_name', 'like', "%${query}%")
                                      ->orWhere('app_id', 'like', "%${query}%")
                                      ->get();
//    dd($items1);
            // Now build a results array
            $results1 = $items1->map(function ($item) use ($query) {

                // If the query is found in the title, set a relevance of 2
                $relevance = mb_stripos($item->title, $query) !== false ? 2 : 1;

                // Optional: Add an age penalty to older results. This makes sure that
                // newer results are listed first.
                // if ($relevance > 1 && $item->published_at) {
                //     $relevance -= $this->getAgePenalty($item->published_at->diffInDays(Carbon::now()));
                // }

                return [
                    'title'     => $item->app_name,
                    'text'      => $item->app_id,
                    'url'       => '/apps/appsDetail/' . $item->idx,
                    //'thumb'     => $item->images->first(), // Instance of System\Models\File
                    'relevance' => $relevance, // higher relevance results in a higher
                                               // position in the results listing
                    // 'meta' => 'data',       // optional, any other information you want
                                               // to associate with this result
                    // 'model' => $item,       // optional, pass along the original model
                ];
            });

            return [
                'provider' => '앱 목록', // The badge to display for this result
                'results'  =>  $results1,
            ];
          });
        }

        public function search2()
        {
            \Event::listen('offline.sitesearch.query', function ($query) {
 //info('searching search2');

            // Search your plugin's contents
            $items2 = Models\AppendixOrderData::where('app_name', 'like', "%${query}%")->get();
  //  dd($items2);
            // Now build a results array
            $results2 = $items2->map(function ($item) use ($query) {

                // If the query is found in the title, set a relevance of 2
                $relevance = mb_stripos($item->title, $query) !== false ? 2 : 1;

                // Optional: Add an age penalty to older results. This makes sure that
                // newer results are listed first.
                // if ($relevance > 1 && $item->published_at) {
                //     $relevance -= $this->getAgePenalty($item->published_at->diffInDays(Carbon::now()));
                // }

                return [
                    'title'     => $item->app_name,
                    'text'      => $item->app_name,
                    'url'       => '/service/servicedetail/' . $item->idx,
                    //'thumb'     => $item->images->first(), // Instance of System\Models\File
                    'relevance' => $relevance, // higher relevance results in a higher
                                               // position in the results listing
                    // 'meta' => 'data',       // optional, any other information you want
                                               // to associate with this result
                    // 'model' => $item,       // optional, pass along the original model
                ];
            });

            return [
                'provider' => '부가서비스 목록', // The badge to display for this result
                'results'  =>  $results2,

            ];
        });
    }
}
