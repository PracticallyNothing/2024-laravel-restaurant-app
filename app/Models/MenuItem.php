<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function prevRevision(): HasOne {
        return $this->hasOne(MenuItem::class, 'prev_revision_id');
    }

    public function nextRevision(): BelongsTo {
        return $this->belongsTo(MenuItem::class, 'next_revision_id');
    }

    public function bills(): BelongsToMany {
        return $this->belongsToMany(Bill::class)->withPivot(['quantity']);
    }

    public function price_bgn_formatted(): string {
        return number_format($this->price_bgn, 2, '.', '');
    }

    public function scopeUpToDate(Builder $query): void {
        $query->whereNull('next_revision_id');
    }
}
