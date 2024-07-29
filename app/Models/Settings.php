<?php

namespace  App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Settings extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_settings';
    protected $fillable = array('field', 'value', 'category');
    public $timestamps = false;

    /**
	*	@param $log Action
	*	@param $info Information Regarding Action
	*	@param $cat Category
	*/
    public function scopeDoEntry($query, $data)
    {
        $log = new self();
        $log->log_time = date('Y-m-d H:i:s');
        $log->log = $data[0];
        $log->info = $data[1];
        $log->cat = $data[2];
        $log->save();
        return $log;
    }


}
