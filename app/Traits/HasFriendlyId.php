<?php

namespace App\Traits;

use App\Services\TenantManager;

trait HasFriendlyId
{
    protected static function bootHasFriendlyId()
    {
        static::creating(function ($model) {
           // Só gera o friendly_id se ele já não tiver sido definido manualmente
            if (! $model->friendly_id) {
                $model->friendly_id = self::nextFriendlyId();
            }
        });
    }

    public static function nextFriendlyId(): int
    {
        $tenantId = app(TenantManager::class)->getTenantId();

        // O 'static' aqui refere-se à classe que está usando a Trait (ex: Order)
        return static::where('tenant_id', $tenantId)
            ->lockForUpdate()
            ->max('friendly_id') + 1;
    }
}
