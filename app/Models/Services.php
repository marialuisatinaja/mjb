<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'title',
        'type',
        'amount',
        'hours',
        'minutes',
        'description',
        'upload',
    ];

    public function packages()
{
    return $this->belongsToMany(Package::class, 'package_services');
}

}
