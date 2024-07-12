<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    // public function pay(){
    //     return $this->belongsTo(Payment::class);
    // }
    public function payment(){
        return $this->belongsTo(Payment::class);
    }
    
    public function mountain(){
        return $this->belongsTo(Mountain::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    // public function group(){
    //     return $this->belongsTo(Group::class);
    // }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }



    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->join('groups', 'reservations.group_id', '=', 'groups.id')
                ->join('users', 'groups.user_id', '=', 'users.id')
                ->where('groups.group_name', 'like', '%' . $search . '%')
                ->orWhere('users.name', 'like', '%' . $search . '%')
                ->orderBy('reservations.created_at', 'desc')
                ->select('reservations.*');
        });

        if (isset($filters['tgl_awal']) && isset($filters['tgl_akhir'])) {
            $query->where(function ($query) use ($filters) {
                $query->whereBetween('groups.checkIn', [$filters['tgl_awal'], $filters['tgl_akhir']])
                    ->orWhereBetween('groups.checkOut', [$filters['tgl_awal'], $filters['tgl_akhir']]);
            });
        } elseif (isset($filters['tgl_awal'])) {
            $query->where(function ($query) use ($filters) {
                $query->whereDate('groups.checkIn', $filters['tgl_awal'])
                    ->orWhereDate('groups.checkOut', $filters['tgl_awal']);
            });
        }
    }


  



    


}