<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'payment_list_id',
        'user_id',
    ];

    /**
     * Get the category that owns the PaymentCategoryDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function list(): BelongsTo
    {
        return $this->belongsTo(PaymentList::class, 'payment_list_id');
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
     * Get the journal associated with the PaymentCategoryDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function journal(): HasOne
    {
        return $this->hasOne(Journal::class, 'payment_id');
    }
}
