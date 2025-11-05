<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RejectedLoan extends Model
{
    protected $fillable = [
        'loan_id',
        'item_loan_id',
        'loan_method',
        'loan_type',
        'product_name',
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
        'rejection_reason',
        'rejected_by',
        'rejected_at',
    ];

    protected $casts = [
        'rejected_at' => 'datetime',
    ];

    // Relationship with Loan
    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    // Relationship with Item Loan
    public function itemLoan()
    {
        return $this->belongsTo(ItemLoan::class);
    }

    // Relationship with User who rejected
    public function rejecter()
    {
        return $this->belongsTo(User::class, 'rejected_by');
    }
}
