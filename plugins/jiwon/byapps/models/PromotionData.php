<?php namespace Jiwon\Byapps\Models;

use Model;

/**
 * Model
 */
class PromotionData extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $primaryKey = 'idx';
    public $timestamps = false;

    public $connection = 'byapps';
    /**
     * @var string The database table used by the model.
     */
    public $table = 'BYAPPS2016_promotion_data';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public $fillable = [
      'pm_title', 'pm_target', 'pm_comment'
    ];
}
