<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    
    public function user() {
    	
    	return $this->belongsTo(User::class, 'from_user_id');
    }

    public function userTo() {
    	
    	return $this->belongsTo(User::class, 'to_user_id');
    }

}
