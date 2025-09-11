<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hotel extends Model
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
        'address'
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'facility_hotels', 'hotel_id', 'facility_id');
    }



    public function isAdmin()
    {
        return $this->roles()->where('name', 'admin')->exists();
    }

    public function isEditor()
    {
        return $this->roles()->where('name', 'editor')->exists();
    }

    public function canBeEditedBy($user): bool
    {
        if (!$user) return false;
        if ($user->isAdmin()) return true;
        if ($user->isEditor() && $this->editor_id === $user->id) return true;
        return false;
    }
}
