<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class AreaScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $areaLogin = Auth::guard('admin')->user();
        $areaId = NULL;
        if ($areaLogin->hasRole("areas")) {
            $areaId = $areaLogin->id;
        }
        $builder->when($areaId, function ($query) use ($areaId) {
            $query->where('area_id', $areaId);
        });
    }
}
