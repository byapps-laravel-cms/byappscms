<?php

use Jiwon\ByApps\Models\PayManage;

Route::get('paymanages', function() {
  $paymanages = PayManage::all();
  return $paymanages;
});
