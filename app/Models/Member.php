<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use HasFactory, SoftDeletes;

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
        'baptism_date',
        'profession',
    ];

    protected $casts = [
        'birthdate' => 'date',
        'baptism_date' => 'date',
        'joined_at' => 'datetime',
    ];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
