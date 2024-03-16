<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductLine extends Model
{
    public $timestamps = false;
    protected $table = "productline";
    protected $connection = "mysql";
    protected $fillable = [
        "name",
        "description",
        "img",
        "date"
    ];

    protected $attributes = [
        "status" => "ACTIVO"
    ];

    public function products(): HasMany {
        return $this->hasMany(Product::class, "productLineId", "productLineId");
    }
}
