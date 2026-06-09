<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use App\Traits\HasFriendlyId;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

//escreva todos os campos da tabela patients no array do Fillable
#[Fillable(['name', 'friendly_id', 'birth_date', 'gender', 'cpf', 'rg', 'email', 'phone_number', 'emergency_contact'])]
class Patient extends Model
{
    use BelongsToTenant, HasFriendlyId, SoftDeletes,HasFactory;

    public function address(): MorphOne
    {
        return $this->morphOne(Address::class, 'addressable');
    }
}
