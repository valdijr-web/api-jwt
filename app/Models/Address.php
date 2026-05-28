<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

#[Fillable(['zip_code', 'street', 'number', 'complement', 'neighborhood', 'city', 'state', 'country'])]
class Address extends Model
{
    public function addressable(): MorphTo
    {
        return $this->morphTo();
    }
}
