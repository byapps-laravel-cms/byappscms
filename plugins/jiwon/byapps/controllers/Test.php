<?php namespace \Jiwon/byapps\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Test Back-end Controller
 */
class Test extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('.Jiwon/byapps', 'jiwon/byapps', 'test');
    }
}
