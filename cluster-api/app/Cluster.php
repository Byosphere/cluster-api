<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cluster extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'country', 'gender', 'firstname', 'lastname', 'profilepicture', 'cluster_id', 'birthdate', 'status', 'introduction'
    ];

    public function members()
    {
        return $this->hasMany('App\User');
    }
}
