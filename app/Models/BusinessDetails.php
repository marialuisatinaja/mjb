<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BusinessDetails extends Model
{
    use HasFactory;

    protected $fillable = [
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
        'status',
        'offers_type',
        'payment_total',
    ];

    public function services(): BelongsTo
    {
        return $this->belongsTo(Services::class, 'service_id', 'id');
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class, 'service_id', 'id');
    }

    public function sales_details(): BelongsTo
    {
        return $this->belongsTo(SalesDetails::class, 'id', 'reservation_id');
    }

}
