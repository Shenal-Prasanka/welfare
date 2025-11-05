<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApprovedLoan extends Model
{
    protected $fillable = [
        'loan_id',
        'item_loan_id',
        'loan_method',
        'loan_type',
        'deduct_time_period',
        'interest_percentage',
        'interest_amount',
        'total_amount',
        'monthly_amount',
        'member_name',
        'member_enlisted_no',
        'member_regiment_no',
        'member_army_id',
        'guarantor1_name',
        'guarantor1_enlisted_no',
        'guarantor1_regiment_no',
        'guarantor1_army_id',
        'guarantor2_name',
        'guarantor2_enlisted_no',
        'guarantor2_regiment_no',
        'guarantor2_army_id',
        'deductions',
    ];

    protected $casts = [
        'deductions' => 'array',
        'loan_type' => 'decimal:2',
        'interest_percentage' => 'decimal:2',
        'interest_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'monthly_amount' => 'decimal:2',
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    public function itemLoan()
    {
        return $this->belongsTo(ItemLoan::class);
    }
}
