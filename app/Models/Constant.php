<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Translatable;

class Constant extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Translatable;

    protected $fillable = ['parent', 'value', 'image'];

    public $translatedAttributes = ['name'];

    public function createTranslation(Request $request)
    {
        foreach (locales() as $key => $language) {
            foreach ($this->translatedAttributes as $attribute) {
                if ($request->get($attribute . '_' . $key) != null && !empty($request->$attribute . $key)) {
                    $this->{$attribute . ':' . $key} = $request->get($attribute . '_' . $key);
                }
            }
            $this->save();
        }
        return $this;
    }



    public static function children()
    {
        return self::query()->where('parent', '!=', 0);
    }
    public function getChildren()
    {
        return self::query()->where('parent', '=', $this->key);
    }
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent')->withDefault();
    }
    public function scopeFilter($q, $search)
    {
        return $q->whereHas('translations', function ($q) use ($search) {
            return $q->where('name', 'like', '%' . $search . '%');
        });

    }


}
