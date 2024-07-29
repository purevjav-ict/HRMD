<?php

namespace  App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Department extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_dept';
    protected $fillable = array('category','user');
    public $timestamps = false;

    public function Task()
    {
        return $this->hasManyThrough('App\Task', 'App\Milestone', 'cat_id', 'milestone_id');
    }

    public function Post()
    {
        return $this->hasMany('App\Models\Employee', 'dept_id');
    }

     /**
      * The attributes that are mass assignable.
      *
      * @var array
      */

    public function scopeValidator($query, array $data)
     {
         return Validator::make($data, [
          'group' => 'required|max:150',
        ]);
     }

    public function scopeDoCreate($query, array $data)
    {

        $emp = new self();
        $emp->department= $data['department'];
        $emp->function = $data['function'];
        $emp->save();
        return $emp;
    }

    public function scopeDoUpdate($query, array $data)
    {

        $emp = self::find($data['id']);
        $emp->department= $data['department'];
        $emp->function = $data['function'];
        $emp->save();
        return $emp;
    }
    
}
