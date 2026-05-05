<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OilChangeCheck extends Model
{
    /** @use HasFactory<\Database\Factories\OilChangeCheckFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'current_odometer',
        'previous_oil_change_date',
        'previous_oil_change_odometer',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'current_odometer' => 'integer',
            'previous_oil_change_odometer' => 'integer',
            'previous_oil_change_date' => 'date',
        ];
    }
}
