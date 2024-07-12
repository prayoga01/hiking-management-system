<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Regulation extends Model
{
    use HasFactory, Searchable;
    protected $guarded = ['id'];

    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
            'type' => $this->type,
        ];
    }
}