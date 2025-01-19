<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pokemon';
    protected $appends = ['altura_cm','peso_kg'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'peso',
        'altura',
        'tipo',
    ];


    public function getAlturaCmAttribute(): float
    {
        return $this->altura * 10;
    }

    public function getPesoKgAttribute(): float
    {
        return $this->peso / 10;
    }
}
