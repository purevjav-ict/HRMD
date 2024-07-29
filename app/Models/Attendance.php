<?php

namespace  App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;
use App\hrm\Logs;

class Attendance extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_attendance';
    protected $fillable = array('emp_id','work_in', 'work_out');
    public $timestamps = false;

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

    public function Emp()
    {
        return $this->belongsTo('App\Models\Employee', 'emp_id');
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
       
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

    public function scopeDoCreate($query, array $data)
    {
        $emp = new self();
        $emp->emp_id= $data['emp_id'];
        $emp->work_in = date('Y-m-d H:i:s', strtotime($data['work_in']));
        $emp->work_out = date('Y-m-d H:i:s', strtotime($data['work_out']));
        $emp->purpose = 'work';
        $emp->guest='NA';
        $emp->contact = '0';
        $emp->save();
        return $emp;
    }

      public function scopeDoCreate2($query, array $data)
    {

        $emp = new self();
        $emp->emp_id=0;
        $emp->work_in = date('Y-m-d H:i:s', strtotime($data['work_in']));
        $emp->work_out = date('Y-m-d H:i:s', strtotime($data['work_out']));
        $emp->guest = $data['guest'];
        $emp->purpose = $data['purpose'];
        $emp->contact = $data['contact'];
        $emp->save();
        return $emp;
    }
    public function scopeDoUpdate($query, array $data)
    {

        $emp = self::find($data['id']);
        $emp->work_in = date('Y-m-d H:i:s', strtotime($data['work_in']));
        $emp->work_out = date('Y-m-d H:i:s', strtotime($data['work_out']));
        $emp->save();
        return $emp;
    }

     public function scopeDoUpdate2($query, array $data)
    {

        $emp = self::find($data['id']);
        $emp->work_in = date('Y-m-d H:i:s', strtotime($data['work_in']));
        $emp->work_out = date('Y-m-d H:i:s', strtotime($data['work_out']));
        $emp->guest = $data['guest'];
        $emp->purpose = $data['purpose'];
        $emp->contact = $data['contact'];
        $emp->save();
        return $emp;
    }
}

