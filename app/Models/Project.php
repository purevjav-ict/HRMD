<?php

namespace  App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Project extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_projects';
    protected $fillable = array('category','user');
    public $timestamps = false;

    public function Task()
    {
        return $this->hasManyThrough('App\Models\Task', 'App\Models\Milestone', 'cat_id', 'milestone_id');
    }

     /**
      * The attributes that are mass assignable.
      *
      * @var array
      */

    public function scopeValidator($query, array $data)
     {
         return Validator::make($data, [
          'proj_title' => 'required|max:150',
          'proj_desc' => 'required|max:500',
          'start_date' => 'required',
          'deadline' => 'required',
        ]);
     }


    public function scopeDoCreate($query, array $data)
    {

        $emp = new self();
        $emp->proj_title= $data['title'];
        $emp->proj_desc = $data['description'];
        $emp->start_date = date('Y-m-d', strtotime($data['start_date']));
        $emp->deadline = date('Y-m-d', strtotime($data['deadline']));
        $emp->status=0;
        $emp->users="";
        $emp->save();
        return $emp;
    }

    public function scopeDoUpdate($query, array $data)
    {

       $emp = self::find($data['id']);
       $emp->proj_title= $data['title'];
       $emp->proj_desc = $data['description'];
       $emp->start_date = date('Y-m-d', strtotime($data['start_date']));
       $emp->deadline = date('Y-m-d', strtotime($data['deadline']));
       $emp->status = $data['status'];
       $emp->users="";
       $emp->save();
       return $emp;
    }
}
