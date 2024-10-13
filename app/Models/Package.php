<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = ['name', 'amount', 'upload','description','persons'];

    // Define the many-to-many relationship with services
    public function services()
    {
        return $this->belongsToMany(Services::class, 'package_services');
    }
    
    
}

