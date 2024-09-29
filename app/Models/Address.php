<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'street',
        'number',
        'zip_code',
        'neighborhood',
        'city',
        'country',
        'state',
    ];

    public function formatted() {
        return "$this->street, $this->number, $this->neighborhood, $this->city, $this->state, {$this->country}.";
    }
}
