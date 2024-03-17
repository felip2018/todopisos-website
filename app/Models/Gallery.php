<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    public $timestamps = false;
    protected $table = "galeryimage";
    protected $connection = "mysql";
    protected $fillable = [
        "productLineId",
        "name",
        "description",
        "url",
        "date"
    ];

    protected $attributes = [
        "status" => "ACTIVO"
    ];

}
