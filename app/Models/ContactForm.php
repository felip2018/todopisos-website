<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactForm extends Model
{
    protected $table = "contactform";
    protected $connection = "mysql";
    protected $fillable = [
        "name",
        "email",
        "phone",
        "message"
    ];

    protected $attributes = [
        "status" => "ACTIVO"
    ];

}
