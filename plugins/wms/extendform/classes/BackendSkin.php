<?php

namespace Wms\ExtendForm\Classes;

use Backend\Skins\Standard;

class BackendSkin extends Standard
{
    public function getLayoutPaths()
    {
        if (class_exists($skin = config('cms.backendOriginalSkin')) && ($skin = app($skin)) && $skin instanceof Standard) {
            $parent = $skin->getLayoutPaths();
        } else {
            $parent = app(Standard::class)->getLayoutPaths();
        }
        array_unshift($parent, '$/wms/extendform/partials/layouts');

        return $parent;
    }
}