<?php namespace Jiwon\Byapps\Models;

use Model;

/**
 * Model
 */
class AppsSaleStat extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;

    public $connection = 'byapps';
    /**
     * @var string The database table used by the model.
     */
    public $table = 'BYAPPS_apps_sale_stat';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
}
