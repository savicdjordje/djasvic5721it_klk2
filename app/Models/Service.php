<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function type()
    {
        return $this->belongsTo(ServiceType::class, 'service_type_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
