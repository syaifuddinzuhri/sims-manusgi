<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentCategoryDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'payment_category_payment_id',
        'user_id',
        'class_id'
    ];

    /**
     * Get the category that owns the PaymentCategoryDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category_payment(): BelongsTo
    {
        return $this->belongsTo(PaymentCategoryPayment::class, 'payment_category_payment_id');
    }

    /**
     * Get the user that owns the PaymentCategoryDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the class that owns the PaymentCategoryDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function class(): BelongsTo
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }
}
