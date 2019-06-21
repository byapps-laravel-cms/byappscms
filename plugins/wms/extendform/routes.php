<?php

use Backend\Classes\Controller as BackendController;
use Backend\Controllers\Auth as AuthController;

BackendController::extend(function(BackendController $controller) {
    $controller->addCss('/plugins/wms/extendform/assets/css/_wms_extend_login_page.css', 'v1.0.1');
    if ($controller instanceof AuthController) {
        $controller->addViewPath('$/wms/extendform/controllers/backend_auth');
    }
});