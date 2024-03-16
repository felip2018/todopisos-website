<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    public $timestamps = false;
    protected $table = "product";
    protected $connection = "mysql";
    protected $fillable = [
        "productLineId",
        "name",
        "description",
        "img",
        "outstanding",
        "date"
    ];

    protected $attributes = [
        "status" => "ACTIVO"
    ];

    public function productLine(): BelongsTo {
        return $this->belongsTo(ProductLine::class, "productLineId");
    }
}
