<?php namespace Jiwon\Byapps\Components;

use Auth;
use Event;
use Input;
use Session;
use Request;
use Redirect;
use Exception;
use Cms\Classes\ComponentBase;
use Cms\Classes\Theme;
use Jiwon\Byapps\Models;

class Badge extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'Badge Component',
            'description' => 'Badge 컴포넌트'
        ];
    }

    public function defineProperties()
    {
        return [
           'badgeClass' => [
             'title'       => 'Badge Class',
             'description' => 'Badge 표시 class',
             'type'        => 'dropdown',
             'default'     => 'badge-light'
           ],
        ];
    }

    public function getBadgeClassOptions() {
        //return $this->getProperties();
        return [
            // 'Badge Light' => 'badge-light',
            // 'Badge Active' => 'badge-danger'
            'badge-light' => 'Badge Light',
            'badge-danger' => 'Badge Active'
        ];
    }

    public function onRun() {

        $badgeClass = $this->property('badgeClass');

        //print_r($badgeClass);

        $this->page['badgeClass'] = $badgeClass;
        return;
    }

}
