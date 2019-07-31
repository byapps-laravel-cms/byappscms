<?php namespace \Jiwon\Byapps\Components;

use Flash;
use Input;
use Session;
use Request;
use Redirect;
use Cms\Classes\ComponentBase;

class SearchForm extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'SearchForm Component',
            'description' => '검색 폼 컴포넌트'
        ];
    }

    public function defineProperties()
    {
        return [];
    }
}
