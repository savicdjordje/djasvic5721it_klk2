<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'service_type_id',
        'image',
        'published',
        'featured',
    ];

    public function type()
    {
        return $this->belongsTo(ServiceType::class, 'service_type_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
