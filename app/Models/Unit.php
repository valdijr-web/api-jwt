<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use App\Traits\HasFriendlyId;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable([
    'friendly_id',
    'tenant_id',
    'name',
    'phone',
    'postal_code',
    'street',
    'number',
    'complement',
    'neighborhood',
    'city',
    'state',
    'is_active',
])]
class Unit extends Model
{
    use BelongsToTenant, HasFriendlyId, SoftDeletes, HasFactory;

}
