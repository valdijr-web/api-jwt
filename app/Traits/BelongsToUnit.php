<?php

namespace App\Traits;

use App\Models\Scopes\UnitScope;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToUnit
{
    protected static function bootBelongsToUnit()
    {
        static::addGlobalScope(new UnitScope);

        static::creating(function ($model) {
            //Se a propriedade unit_id já foi definida manualmente no código, respeita ela
            if (! $model->unit_id) {
                // Tenta pegar o ID usando a mesma hierarquia do escopo
                $unitId = auth('api')->check()
                    ? auth('api')->user()->unit_id
                    : (request()->header('X-Unit-ID') ?? request()->input('unit_id'));

                if ($unitId) {
                    $model->unit_id = $unitId;
                }
            }
        });
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }
}
