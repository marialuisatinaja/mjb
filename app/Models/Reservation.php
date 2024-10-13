<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'service_type',
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'email',
        'phone',
        'type',
        'preffered',
        'total_person',
        'boy_therapist',
        'girl_therapist',
        'date',
        'time',
        'message',
        'status',
    ];


    public function services(): BelongsTo
    {
        return $this->belongsTo(Services::class, 'service_id', 'id');
    }

}
