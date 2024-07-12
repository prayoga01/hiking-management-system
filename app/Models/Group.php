<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function mountain(){
        return $this->belongsTo(Mountain::class);
    }

    // public function mountainAble(){
    //     return $this->belongsTo(MountainAble::class);
    // }

    // Group.php

    public function mountainAble()
    {
        return $this->belongsTo(MountainAble::class, 'mountainAble_id');
    }

    
    public function payment(){
        return $this->belongsTo(Payment::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'group_id');
    }
}