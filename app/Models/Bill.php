<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bill extends Model
{
    use HasFactory;

    public function isClosed(): bool {
        return $this->time_closed != null;
    }

    public function humanReadableAge(): string {
        return $this->created_at->diffForHumans();
    }

    public function total(): float {
        return 0.0;
    }

    public function table(): BelongsTo {
        return $this->belongsTo(Table::class);
    }

    public function scopeOpen(Builder $query): void
    {
        $query->whereNull('time_closed');
    }

    public function scopeUnpayed(Builder $query): void
    {
        $query->where('time_closed', 'is not', null)->where('is_payed', '=', false);
    }
}
