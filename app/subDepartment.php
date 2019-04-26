<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subDepartment extends Model
{
    
    protected $table = 'subDepartments';

    public function mainDepartment () {

    	return $this->belongsTo(mainDepartment::class, 'mainDepartment_id');
    }

    public function employee () {

    	return $this->hasMany(Employee::class, 'depart_id');
    }

    public function hod () {
    	return  $this->belongsTo(Employee::class);
    }

    public function departmentBelong () {
        return $this->morphMany('App\subDepartment', 'department');
    }
}
