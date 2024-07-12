<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Payment extends Model
{
    use HasFactory, Searchable;
    
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function rsv(){
        return $this->belongsTo(Reservation::class);
    }
    
    public function group(){
        return $this->belongsTo(Group::class);
    }
    
    public function mountain(){
        return $this->belongsTo(Mountain::class);
    }
    public function mountainable(){
        return $this->belongsTo(MountainAble::class);
    }


    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->join('users', 'payments.user_id', '=', 'users.id')
                ->where('payments.ref_id', 'like', '%' . $search . '%')
                ->orWhere('users.name', 'like', '%' . $search . '%')
                ->orderBy('payments.created_at', 'desc')
                ->select('payments.*');
        });
    }

    public function scopeTgl($query, array $filters)
    {
        if (isset($filters['tgl_awal']) && isset($filters['tgl_akhir'])) {
            $query->whereBetween('pay_date', [$filters['tgl_awal'], $filters['tgl_akhir']]);
        } elseif (isset($filters['tgl_awal'])) {
            $query->whereDate('pay_date', $filters['tgl_awal']);
        }
    }

   
    
}