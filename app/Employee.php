<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
	
    protected $table = 'users';
    
    public function subDepartment () {

    	return $this->belongsTo(subDepartment::class, 'depart_id');
    }

    public function mainDepartment () {

    	return $this->belongsTo(mainDepartment::class, 'depart_id');
    }

    public function maindepartmentHead () {

    	return $this->hasMany(mainDepartment::class, 'hod_id');
    }

    public function subdepartmentHead () {

        return $this->hasMany(subDepartment::class, 'hod_id');
    }

    public function position () {

    	return $this->belongsTo(Position::class);
    }

    public function department () {
        return $this->morphTo();
    }
}
