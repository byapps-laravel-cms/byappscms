<?php

// DB table to use
$table = $_POST['tb'];

// Table's primary key
$primaryKey = 'idx';

$columns = array(
    array( 'db' => 'idx', 'dt' => 0 ),
    array( 'db' => 'app_id', 'dt' => 1 ),
    array( 'db' => 'app_name', 'dt' => 2 ),
    array( 'db' => 'app_ver', 'dt' => 3 ),
    array( 'db' => 'byapps_ver', 'dt' => 4 ),
    array(
        'db' => 'app_process',
        'dt' => 5,
        'formatter' => function($d, $row) {
          $arrProcess = [
              1 => '개발준비중', 2 => '개발진행중', 3 => '심사중', 4 => '등록거부',
              5 => '재심사중', 6 => '등록대기', 7 => '등록완료', 8 => '서비스중지',
              9 => '기간만료', 10 => '서비스유효'
           ];
           foreach ($arrProcess as $key=>$val) {
             if($d == $key) {
                return $arrProcess[$key];
             }
           }
        }
    ),
    array(
      'db' => 'script_popup',
      'dt' => 6,
      'formatter' => function($d, $row) {
        if($d == 'Y') {
            return '설치됨';
        } else {
            return '-';
        }
      }
    ),
    array( 'db' => 'custom_etc', 'dt' => 7 ),
    array( 'db' => 'apps_type', 'dt' => 8 ),
    array(
      'db' => 'start_time',
      'dt' => 9,
    ),
    array(
      'db' => 'reg_time',
      'dt' => 10
    ),
);

//SQL server connection information
$sql_details = array(
    'user' => 'ljw',
    'pass' => 'tprP1emd!#',
    'db'   => 'marutm1',
    'host' => 'localhost'
);


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
    * If you just want to use the basic configuration for DataTables with PHP
    * server-side, there is no need to edit below this line.
    */

require( 'ssp.class.php' );

$result = SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns);

echo json_encode($result);


// 기간 계산 종료일 - 시작일
function calculDate($val1, $val2)
{
    // $today = date("Y-m-d h:i:s", time());
    $dday = (($val2 - $val1) / 86400);

    return ceil($dday);
}
