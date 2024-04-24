<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
        $menuItems = $this->menuItems()->get();

        $sum = 0;
        foreach ($menuItems as $menuItem) {
            $sum += $menuItem->price_bgn * $menuItem->pivot->quantity;
        }

        return $sum;
    }

    public function totalFormatted(): string {
        return number_format($this->total(), 2, '.', '');
    }

    public function table(): BelongsTo {
        return $this->belongsTo(Table::class);
    }

    public function menuItems(): BelongsToMany {
        return $this->belongsToMany(MenuItem::class)->withPivot(['quantity']);
    }

    public function scopeOpen(Builder $query): void
    {
        $query->whereNull('time_closed');
    }

    public function scopeClosed(Builder $query): void
    {
        $query->whereNotNull('time_closed');
    }

    public function scopeUnpayed(Builder $query): void
    {
        $query->where('time_closed', 'is not', null)->where('is_payed', '=', false);
    }
}
