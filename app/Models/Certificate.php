<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Certificate extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'duration','service_id'];


    public function services(): BelongsTo
    {
        return $this->belongsTo(Services::class, 'service_id', 'id');
    }
}
