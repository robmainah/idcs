<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mainDepartment extends Model
{
    
    protected $table = 'mainDepartments';

    public function subDepartment () {
    	
    	return $this->hasMany(subDepartment::class, 'mainDepartment_id');
    }

    public function employee () {

    	return $this->hasMany(Employee::class, 'depart_id');
    }

    public function hod () {
    	return  $this->belongsTo(Employee::class);
    }

    public function departmentBelong () {
        return $this->morphMany('App\mainDepartment', 'department');
    }
}
