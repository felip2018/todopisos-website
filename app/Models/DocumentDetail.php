<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocumentDetail extends Model
{
    public $timestamps = false;
    protected $table = "documentdetail";
    protected $connection = "mysql";
    protected $fillable = [
        "idDocument",
        "idProduct",
        "description",
        "unitPrice",
        "quantity",
        "totalPrice"
    ];

    public function product(): BelongsTo {
        return $this->belongsTo(Product::class, "idProduct", "productId");
    }
}
