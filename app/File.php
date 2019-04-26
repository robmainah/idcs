<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $guarded = ['id'];

    public function user() {
    	
    	return $this->belongsTo(User::class, 'employee_id');
    }
    
    public function calculateFileSize($image)
	{
	    $size = filesize($image);
	    $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
	    $power = $size > 0 ? floor(log($size, 1024)) : 0;
	    return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
	}
}
