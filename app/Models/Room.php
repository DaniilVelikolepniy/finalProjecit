<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'name',
        'description',
        'poster_url',
        'floor_area',
        'type',
        'price',
        'hotel_id',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    // public function facilities()
    // {
    //     return $this->belongsToMany(Facility::class, 'facility_room');
    // }

    // public function bookings()
    // {
    //     return $this->hasMany(Booking::class);
    // }
}
