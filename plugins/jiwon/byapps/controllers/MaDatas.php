<?php namespace Jiwon\Byapps\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class MaDatas extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController'    ];

    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Jiwon.Byapps', 'main-menu-item4', 'side-menu-item2');
    }
}
