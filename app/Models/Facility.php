<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Facility extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ['name'];

    public function hotels()
    {
        return $this->belongsToMany(Hotel::class, 'facility_hotel');
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'facility_room');
    }
}
