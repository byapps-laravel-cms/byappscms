<?php namespace Jiwon\Byapps\Models;

use Model;

/**
 * Model
 */
class MaData extends Model
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
    public $table = 'BYAPPS_MA_data';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public $hasOne = [
      'joins' => [
        'Jiwon\Byapps\Models\PaymentData',
        'key' => 'order_id',
        'otherKey' => 'order_id'
      ]
    ];
}
