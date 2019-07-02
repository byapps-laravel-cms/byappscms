<?php

namespace Wms\ExtendForm;

use Backend\Classes\Controller as BackendController;
use Backend\Classes\Controller;
use System\Classes\PluginBase;
use Wms\Settings\Models\Settings as SettingsModel;

class Plugin extends PluginBase
{
    private $showImageMaps = null;

    public function pluginDetails()
    {
        return [
            'name'        => 'wms.extendform::plugin.name',
            'description' => 'wms.extendform::plugin.description',
            'author'      => 'WMStudio',
            'icon'        => 'icon-leaf',
        ];
    }

    public function register()
    {
        if (class_exists($skin = config('cms.backendSkin'))) {
            config()->set('cms.backendOriginalSkin', $skin);
            config()->set('cms.backendSkin', Classes\BackendSkin::class);
        }

        BackendController::extend(function(BackendController $controller) {
            $controller->addJs('/plugins/wms/extendform/assets/js/jquery.inputmask.min.js', 'v5.0.0-beta.82');
            $controller->addJs('/plugins/wms/extendform/assets/js/_wms_extend_form.js', 'v1.0.1');
            $controller->addCss('/plugins/wms/extendform/assets/css/_wms_extend_form.css', 'v1.0.2');
        });

        Classes\Extend::extendController();
        Classes\Extend::extendForm();
    }

    public function boot()
    {
        if ($this->showImageMaps == null) {
            if (class_exists(SettingsModel::class)) {
                $this->showImageMaps = SettingsModel::get('show_image_maps');
            } else {
                $this->showImageMaps = true;
            }
        }

        Controller::extend(function($controller) {
            /* @var $controller Controller */
            $controller->addDynamicProperty('showImageMaps', $this->showImageMaps);
        });

        \Validator::extend(
            'phone',
            \Propaganistas\LaravelPhone\Validation\Phone::class . '@validate',
            trans('wms.extendform::lang.validation.phone')
        );
    }

    public function registerListColumnTypes()
    {
        return Classes\Extend::getListColumnTypes() + [];
    }

    public function registerComponents()
    {
        //return [
        //    'Wms\ExtendForm\Components\MyComponent' => 'myComponent',
        //];
    }

    public function registerPermissions()
    {
        //return [
        //    'wms.extendform.some_permission' => [
        //        'tab' => 'ExtendForm',
        //        'label' => 'Some permission'
        //    ],
        //];
    }

    public function registerNavigation()
    {
        //return [
        //    'extendform' => [
        //        'label'       => 'ExtendForm',
        //        'url'         => Backend::url('wms/extendform/mycontroller'),
        //        'icon'        => 'icon-leaf',
        //        'permissions' => ['wms.extendform.*'],
        //        'order'       => 500,
        //    ],
        //];
    }
}
