<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SalesDetails extends Model
{
    use HasFactory;
    protected $fillable = ['reservation_id','email','therapist_id'];

 

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'therapist_id'); 
    }

}
