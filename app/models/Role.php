<?php

namespace App\models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $table = 'roles';

    protected $fillable = [
        'name',
        'slug',
        'created_at',
        'updated_at'
    ];

    public function users() {
        return $this->hasMany(User::class);
    }
}
