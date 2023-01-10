<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opinion extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string, string>
     */
    protected $fillable = [
        'text',
        'score',
        'customer_id',
        'petsitter_id'
    ];

    public function petsitter()
    {
        return $this->hasOne(User::class, 'id', 'petsitter_id')->where('role', 'Petsitter');
    }

    public function customer()
    {
        return $this->hasOne(User::class, 'id', 'customer_id')->where('role', 'Customer');
    }
}
