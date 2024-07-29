<?php

namespace  App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Input;
use Image;
use Hash;



class Employee extends Model
{

     use HasFactory;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_emp';
    public $timestamps = false;

    public function Post()
    {
        return $this->belongsTo('App\Models\Post', 'post_id');
    }

    public function Attendance()
    {
        return $this->hasMany('App\Models\Attendance', 'emp_id');
    }

    public function Timesheet()
    {
        return $this->hasMany('App\Models\Timesheet', 'emp_id');
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

    public function scopeUpdateStat($query, $id, $stat)
    {
        $user = self::find($id);
        $user->status = $stat;
        $user->finish_dt = '0000-00-00';
        if ($stat == 1) {
            $user->finish_dt = date('Y-m-d');
        }
        $user->save();
        return $user;
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
          'name' => 'required|max:100',
          'email' => 'required|email',
        ]);
    }

   

    public function scopeDoCreate($query, array $data)
    {

        $emp = new self();
        $emp->name= $data['name'];
        $emp->post_id = $data['posting'];
        $emp->father = $data['father'];
        $emp->dob = date('Y-m-d', strtotime($data['dob']));
        $emp->doj = date('Y-m-d', strtotime($data['doj']));
        $emp->password=Hash::make('123456');
        $emp->mobile = $data['mobile'];
        $emp->email = $data['email'];
        $emp->salary = $data['salary'];
        $emp->facebook = "";
         $emp->twitter = "";
         $emp->github = "";
         $emp->linkedin = "";
         $emp->photo = "";
         $emp->resume = "";
        $emp->sex=$data['sex'];
        $emp->address = $data['address'];
        $emp->notes = $data['notes'];
        $emp->hourly=0;
        $emp->status=1;
        $emp->save();
        
        //for photo upload
        if (isset($data['photo']))
        {   

            $ext=$data['photo']->getClientOriginalExtension();
            $file_name=$emp['id'].".".$ext;
            $path1=base_path().'/uploads/photo/';
            $path = $path1.$file_name;
            $image = Input::file('photo');
            Image::make($image->getRealPath())->resize(150, 150)->save($path);

             $emp->photo = $file_name;

        }

        else{
             $emp->photo = 'default.jpg';            
        }
        //for resume upload
        if (isset($data['resume']))
        {   
            $ext=$data['resume']->getClientOriginalExtension();
            $file_name=$emp['id'].".".$ext;
            $path=base_path().'/uploads/resume';
            $data['resume']->move($path, $file_name); 
            $emp->resume = $file_name; 
        }
        $emp->save();
        return $emp;
    }
    
    public function scopeDoUpdate($query, array $data)
    {

        $emp = self::find($data['id']);
        $emp->name= $data['name'];
        $emp->post_id = $data['posting'];
        $emp->father = $data['father'];
        $emp->dob = date('Y-m-d', strtotime($data['dob']));
        $emp->doj = date('Y-m-d', strtotime($data['doj']));
        $emp->mobile = $data['mobile'];
        $emp->email = $data['email'];
        $emp->salary = $data['salary'];
        $emp->facebook = $data['facebook'];
        $emp->twitter = $data['twitter'];
        $emp->github = $data['github'];
        $emp->linkedin = $data['linkedin'];
        $emp->address = $data['address'];
        $emp->notes = $data['notes'];
        $emp->status=$data['status'];
        

        //for photo upload
        if (isset($data['photo']))
        {   

            $ext=$data['photo']->getClientOriginalExtension();
            $file_name=$data['id'].".".$ext;
            $path1=base_path().'/uploads/photo/';
            $path = $path1.$file_name;
            $image = Input::file('photo');
            Image::make($image->getRealPath())->resize(150, 150)->save($path);
            $emp->photo = $file_name;

        }
        
        //for resume upload
        if (isset($data['resume']))
        {   
            $ext=$data['resume']->getClientOriginalExtension();
            $file_name=$data['id'].".".$ext;
            $path=base_path().'/uploads/resume';
            $data['resume']->move($path, $file_name); 
            $emp->resume = $file_name; 
        }
        $emp->save();
        

return $emp;
    }
}

