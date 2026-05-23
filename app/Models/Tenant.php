<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
#[Fillable(['trade_name', 'company_name', 'plan', 'status', 'document', 'document_type', 'whatsapp_number', 'is_active'])]
class Tenant extends Model
{
    use HasFactory;
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
