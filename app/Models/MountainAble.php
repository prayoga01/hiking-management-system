<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class MountainAble extends Model
{
    use HasFactory, Searchable;
    protected $guarded = ['id'];

   
 
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->join('mountains', 'mountain_ables.mountain_id', '=', 'mountains.id')
                ->where('mountain_ables.price', 'like', '%' . $search . '%')
                ->orWhere('mountains.nm_mountain', 'like', '%' . $search . '%')
                ->orderBy('mountain_ables.created_at', 'desc')
                ->select('mountain_ables.*'); // Tambahkan select untuk memilih semua kolom dari mountain_ables
        });
    }
    
    public function scopeTgl($query, array $filters)
    {
        if (isset($filters['tgl_awal']) && isset($filters['tgl_akhir'])) {
            $query->whereBetween('date_able', [$filters['tgl_awal'], $filters['tgl_akhir']]);
        } elseif (isset($filters['tgl_awal'])) {
            $query->whereDate('date_able', $filters['tgl_awal']);
        }
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function mountain(){
        return $this->belongsTo(Mountain::class);
    }

    public function groups()
    {
        return $this->hasMany(Group::class, 'mountainAble_id');
    }

    
}