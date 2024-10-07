<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PackageServices extends Model
{
    use HasFactory;
    protected $fillable = ['package_id', 'service_id'];

    public function services(): BelongsTo
    {
        return $this->belongsTo(Services::class, 'service_id'); 
    }
}
