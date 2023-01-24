<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string, string>
     */
    protected $fillable = [
        'service_id',
        'city_id',
        'weight',
        'age',
        'petsitter_id',
        'customer_id'
    ];

    public function service()
    {
        return $this->hasOne(Service::class);
    }

    public function city()
    {
        return $this->hasOne(City::class);
    }

    public function petsitter()
    {
        return $this->hasOne(User::class, 'id', 'petsitter_id')->where('role', 'Petsitter');
    }

    public function customer()
    {
        return $this->hasOne(User::class, 'id', 'customer_id')->where('role', 'Customer');
    }
}
