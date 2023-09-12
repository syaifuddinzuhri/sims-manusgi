<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $appends = [
        'name'
    ];

    protected $fillable = [
        'payment_type_id',
        'academic_year_id',
        'type',
        'group'
    ];

    /**
     * Get the type that owns the PaymentCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function payment_type(): BelongsTo
    {
        return $this->belongsTo(PaymentType::class, 'payment_type_id');
    }

    /**
     * Get the academic that owns the PaymentCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function academic(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class, 'academic_year_id');
    }

    public function getNameAttribute()
    {
        $payment_type = $this->payment_type ? $this->payment_type->name : '';
        $academic = $this->academic;
        $year = " ";
        if ($academic) {
            $year = " (TA. " . $academic->first_year . '/' . $academic->last_year . ' - ' . ($academic->semester == 1 ? 'Ganjil' : 'Genap') . ")";
        }
        return $payment_type . $year;
    }
}
