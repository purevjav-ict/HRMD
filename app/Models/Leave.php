<?php

namespace  App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Leave extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_leave';
    public $timestamps = false;

    public function Emp()
    {
        return $this->belongsTo('App\Models\Employee', 'emp_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['item', 'description', 'password'];
    protected $hidden = ['password', 'remember_token'];

    public function scopeShowRecords($query, $idw)
    {
        $users = self::where('user_id', '=', $idw)->take(100)->paginate(5);
        return $users;
    }

    public function scopeFindRecords($query, $idw)
    {
       $users = self::where('id', '=', $idw)->get();
       return $users;
    }


    public function scopeCreateValidator($query, array $data)
    {
        return Validator::make($data, [
          'title' => 'required|max:100',
          'description' => 'required|max:150',
          'schedule_dt' => 'required|min:8',
        ]);
    }

    public function scopeEditValidators($query, array $data)
    {
        return Validator::make($data, [
          'title' => 'required|max:100',
          'description' => 'required|max:150',
          'schedule_dt' => 'required|min:8',
        ]);
    }
 
    public function scopeDoCreate($query, array $data)
    {

        $emp = new self();
        $emp->emp_id= $data['emp_id'];
        $emp->start_date = date('Y-m-d', strtotime($data['start_date']));
        $emp->end_date = date('Y-m-d', strtotime($data['end_date']));
        $emp->reason = $data['reason'];
        $emp->status = 0;
        $emp->save();
        return $emp;
    }
    
    public function scopeDoUpdate($query, array $data)
    {

        $emp = self::find($data['id']);
        $emp->start_date = date('Y-m-d', strtotime($data['start_date']));
        $emp->end_date = date('Y-m-d', strtotime($data['end_date']));
        $emp->reason = $data['reason'];
        $emp->status = $data['status'];
        $emp->save();
        return $emp;
    }

    public function scopeDoApprove($query, array $data)
    {

        $emp = self::find($data['id']);
        $emp->status = $data['status'];
        $emp->save();
        return $emp;
    }
}

