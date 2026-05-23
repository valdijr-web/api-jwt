<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use App\Traits\HasFriendlyId;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
//escreva todos os campos da tabela patients no array do Fillable
#[Fillable(['name', 'friendly_id', 'birth_date', 'gender', 'cpf', 'rg', 'email', 'phone_number', 'emergency_contact', 'zip_code', 'street', 'address_number', 'complement', 'neighborhood', 'city', 'state', 'country'])]
class Patient extends Model
{
    use BelongsToTenant, HasFriendlyId;
}
