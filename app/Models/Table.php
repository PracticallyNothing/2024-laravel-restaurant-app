<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Table extends Model
{
    use HasFactory;

    public function bills(): HasMany {
        return $this->hasMany(Bill::class);
    }

    public function isTaken(): bool {
        return $this->bills()->where('time_closed', null)->first() != null;
    }
}
