<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentCategoryPayment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'payment_category_id',
        'free_amount',
        'january_amount',
        'february_amount',
        'march_amount',
        'april_amount',
        'may_amount',
        'juny_amount',
        'july_amount',
        'augustus_amount',
        'september_amount',
        'october_amount',
        'november_amount',
        'december_amount',
    ];

    /**
     * Get the payment_category that owns the PaymentCategoryPayment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function payment_category(): BelongsTo
    {
        return $this->belongsTo(PaymentCategory::class, 'payment_category_id');
    }
}
