<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FacilityHotel extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'facility_id',
        'hotel_id'
    ];
}
