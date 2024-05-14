<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cpf',
        'rg',
        'email',
        'phone',
        'whatsapp',
        'address_zipcode',
        'address_street',
        'address_number',
        'address_neighborhood',
        'city',
        'uf',
        'birthdate',
        'joined_at',
        'status_id',
        'photo',
    ];

    protected $casts = [
        'birthdate' => 'date',
        'joined_at' => 'datetime',
    ];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
