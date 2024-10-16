<?php

namespace App\Models;

use App\Models\Scopes\InstitutionScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provider extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ["name", "phone", "email", "image", "country", "institution_id", "location_id"];

    protected static function booted()
    {
        static::addGlobalScope(new InstitutionScope);
    }

    public function institution()
    {
        return $this->belongsTo(Admin::class, 'institution_id', 'id');
    }

    public function location()
    {
        return $this->belongsTo(Area::class, 'location_id', 'id');
    }

    public function scopeFilter($q, $search)
    {
        return $q->where('name', 'like', '%' . $search . '%');
    }
}
