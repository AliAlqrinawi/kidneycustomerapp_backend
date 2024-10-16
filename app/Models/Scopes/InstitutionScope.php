<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class InstitutionScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $institutionsLogin = Auth::guard('admin')->user();
        $institutionId = NULL;
        if($institutionsLogin->hasRole("institutions")){
            $institutionId = $institutionsLogin->id;
        }
        $builder->when($institutionId , function($query) use($institutionId){
            $query->where('institution_id', $institutionId );
        });
    }
}
