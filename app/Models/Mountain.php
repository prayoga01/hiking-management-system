<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;


class Mountain extends Model 
{
    use HasFactory,  Searchable;
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function toSearchableArray()
    {
        return [
            'nm_mountain' => $this->nm_mountain,
            'address_mountain' => $this->address_mountain,
        ];
    }

    public function mountainAbles()
    {
        return $this->hasMany(MountainAble::class);
    }
}