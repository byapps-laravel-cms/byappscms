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
=======
    // 다른 DB불러오기
>>>>>>> 46b6c03aff7f11902c7fecd9a98e029d8e45fd80
    public $connection = 'byapps';

    /**
     * @var string The database table used by the model.
     */
<<<<<<< HEAD
=======
    //public $table = 'jiwon_byapps_apk_data';
>>>>>>> 46b6c03aff7f11902c7fecd9a98e029d8e45fd80
    public $table = 'BYAPPS_apps_update_data';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
}
