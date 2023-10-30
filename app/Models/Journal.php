<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Journal extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'date',
        'name',
        'amount',
        'notes',
        'journal_category_id',
        'payment_category_detail_id'
    ];

    /**
     * Get the category that owns the Journal
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(JournalCategory::class, 'journal_category_id');
    }

    /**
     * Get the payment_category_detail that owns the Journal
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function payment_category_detail(): BelongsTo
    {
        return $this->belongsTo(PaymentCategoryDetail::class, 'payment_category_detail_id');
    }
}
