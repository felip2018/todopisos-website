<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Document extends Model
{
    public $timestamps = false;
    protected $table = "document";
    protected $connection = "mysql";
    protected $fillable = [
        "userId",
        "type",
        "number",
        "observations",
        "total",
        "advancement",
        "balance",
        "date"
    ];

    protected $attributes = [
        "status" => "ACTIVO"
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "userId", "userId");
    }

    public function productsList(): HasMany
    {
        return $this->hasMany(DocumentDetail::class, "idDocument", "idDocument");
    }
}
