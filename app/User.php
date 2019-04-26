<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Task;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'verifyToken', 'Dob', 'phoneNumber','address', 'role','depart_id', 'image', 'depart_type', 'accessLevel', 'gender',
                   // $employee->depart_type = get_class($employee);'accessLevel' => 1,'active' => 1,
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    

    // public function employee () {

    //     return $this->hasMany(Employee::class);
    // }

}
