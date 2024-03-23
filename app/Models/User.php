<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Model
{
    public $timestamps = false;
    protected $table = "user";
    protected $connection = "mysql";
    protected $fillable = [
        "documentTypeId",
        "docNum",
        "profileId",
        "name",
        "surname",
        "email",
        "phone",
        "address",
        "password",
        "cityId",
        "date"
    ];

    protected $attributes = [
        "status" => "ACTIVO"
    ];
}
