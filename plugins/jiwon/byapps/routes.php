<?php

Route::get('pay/paylist/:page', 'Jiwon\Byapps\Components\Datatable@getPaymentData');

Route::get('pay/promolist/:page', 'Jiwon\Byapps\Components\Datatable@getPromotionData');
