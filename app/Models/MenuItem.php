<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MenuItem extends Model
{
    use HasFactory;

    public function prevRevision(): HasOne {
        return $this->hasOne(MenuItem::class);
    }

    public function nextRevision(): BelongsTo {
        return $this->belongsTo(MenuItem::class);
    }

    public function scopeUpToDate(Builder $query): void {
        $query->whereNull('next_revision_id')
            ->whereNull('deleted_at');
    }
}
