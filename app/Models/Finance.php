<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaction_type',
        'title',
        'source',
        'date_transfer',
        'value',
        'description',
    ];
}
