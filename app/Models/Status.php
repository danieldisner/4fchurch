<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'tailwind_classes',
    ];

    public function members()
    {
        return $this->hasMany(Member::class);
    }
}
