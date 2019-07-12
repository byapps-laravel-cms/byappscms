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
use Symfony\Component\Yaml\Yaml;


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
           'badge-class' => [
             'title'       => 'Badge Class',
             'description' => 'The class attribute for the Badge.',
             'type'        => 'number',
             'default'     => 'badge-light'
           ],
           'badge-active-class' => [
                'title'       => 'Badge Active class',
                'description' => 'The class attribute for the active Badge.',
                'type'        => 'number',
                'default'     => 'badge-danger'
           ],
        ];
    }

    public function getOptions() {
        return $this->getProperties();
    }

    public function onRun() {
        // if (!($theme = Theme::getEditTheme())) {
        //     throw new ApplicationException(Lang::get('cms::lang.theme.edit.not_found'));
        // }
        //
        // $currentPage = $this->page->baseFileName;
        // $pages = Page::listInTheme($theme, true);
        //
        // $this->pagesList = $this->buildPagesList($pages);
        // $breadcrumbList = $this->buildCrumbTrail($currentPage);
        //
        $currentBadge = 60;
        $badgeClass = 'badge-danger';
        // $this->page['badge'] = $badgeList;
        $this->page['currentBadge'] = $currentBadge;
        $this->page['badgeClass'] = $badgeClass;
        return;
    }

}
