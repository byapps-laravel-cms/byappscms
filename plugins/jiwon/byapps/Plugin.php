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
            //'RainLab\Builder\Components\RecordDetails'    => 'builderDetails'
        ];
    }

    public function registerSettings()
    {
    }

    // public function registerNavigation()
    // {
    //     return [
    //         'byapps' => [
    //             'label'       => 'jiwon.byapps::lang.paymentdatas.menu_label',
    //             'url'         => Backend::url('jiwon/byapps/paymentdatas'),
    //             'icon'        => 'icon-pencil',
    //             'iconSvg'     => 'plugins/rainlab/blog/assets/images/blog-icon.svg',
    //             // 'permissions' => ['rainlab.blog.*'],
    //             'order'       => 500,
    //
    //             'sideMenu' => [
    //                 'promotiondatas' => [
    //                     'label'       => 'jiwon.byapps::lang.promotiondatas.menu_label',
    //                     'icon'        => 'icon-plus',
    //                     'url'         => Backend::url('jiwon/byapps/promotiondatas'),
    //                     // 'permissions' => ['rainlab.blog.access_posts']
    //                     'counterLabel' => '99',
    //                 ],
    //             ]
    //         ]
    //     ];
    // }
}
