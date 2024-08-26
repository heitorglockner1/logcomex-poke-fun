<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    use HasFactory;

    protected $table = 'pokemons';

    protected $fillable = [
        'name',
        'height',
        'weight',
        'type_id',
    ];

    public function types()
    {
        return $this->belongsToMany(Type::class)->withPivot('slot');
    }
}
