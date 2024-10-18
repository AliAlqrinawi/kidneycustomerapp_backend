<?php

namespace App\Models;

use App\Models\Scopes\InstitutionScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'time', 'note', 'institution_id', 'provider_id' , 'user_id'];

    protected $casts = [
        'date' => 'date',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new InstitutionScope);
    }

    public function institution()
    {
        return $this->belongsTo(Admin::class, 'institution_id', 'id');
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
}
