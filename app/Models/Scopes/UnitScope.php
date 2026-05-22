<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class UnitScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $unitId = null;
        // Cenário A: Usuário autenticado (Painel Web do MVP)
        if (auth('api')->check()) {
            $unitId = auth('api')->user()->unit_id;
        }
        // Cenário B: Requisição externa/IA (Sem usuário autenticado)
        elseif (request()->hasHeader('X-Unit-ID')) {
            $unitId = request()->header('X-Unit-ID');
        }
        // Cenário C: Fallback para parâmetro na URL ou Body da request (opcional)
        elseif (request()->has('unit_id')) {
            $unitId = request()->input('unit_id');
        }

        // Se encontrou o ID da unidade por qualquer um dos meios, aplica o filtro
        if ($unitId) {
            $builder->where($model->getTable() . '.unit_id', $unitId);
        }

    }
}
