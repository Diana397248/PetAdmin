<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'vet_id',
        'title',
        'description',
        'start_time',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function vet()
    {
        return $this->belongsTo(Vet::class);
    }
}
