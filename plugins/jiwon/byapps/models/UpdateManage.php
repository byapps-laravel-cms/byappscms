<?php namespace Jiwon\Byapps\Models;

use Model;

/**
 * Model
 */
class UpdateManage extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;

<<<<<<< HEAD
<<<<<<< HEAD
=======
    // 다른 DB불러오기
>>>>>>> 46b6c03aff7f11902c7fecd9a98e029d8e45fd80
=======
    // 다른 DB불러오기
=======
>>>>>>> develop
>>>>>>> a454bcef5dcf7867c674f2b49313e3278579304b
    public $connection = 'byapps';

    /**
     * @var string The database table used by the model.
     */
<<<<<<< HEAD
<<<<<<< HEAD
=======
    //public $table = 'jiwon_byapps_apk_data';
>>>>>>> 46b6c03aff7f11902c7fecd9a98e029d8e45fd80
=======
    //public $table = 'jiwon_byapps_apk_data';
=======
>>>>>>> develop
>>>>>>> a454bcef5dcf7867c674f2b49313e3278579304b
    public $table = 'BYAPPS_apps_update_data';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
<<<<<<< HEAD

    public $hasMany = [
      'joins' => [
        'Jiwon\Byapps\Models\ApkData',
        'key' => 'idx'
      ]
    ];
=======
>>>>>>> develop
}
