<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonIssued extends Model
{
    protected $fillable = [
        'item_loan_id',
        'approved_loan_id',
        'stock_id',
        'member_enlisted_no',
        'member_enlisted_date',
        'member_name',
        'member_rank',
        'member_regiment_no',
        'member_nic',
        'member_army_id',
        'member_previous_unit',
        'guarantor1_enlisted_no',
        'guarantor1_enlisted_date',
        'guarantor1_name',
        'guarantor1_rank',
        'guarantor1_regiment_no',
        'guarantor1_nic',
        'guarantor1_army_id',
        'guarantor1_previous_unit',
        'guarantor2_enlisted_no',
        'guarantor2_enlisted_date',
        'guarantor2_name',
        'guarantor2_rank',
        'guarantor2_regiment_no',
        'guarantor2_nic',
        'guarantor2_army_id',
        'guarantor2_previous_unit',
        'item_code',
        'item_name',
        'item_model',
        'serial_number',
        'category',
    ];

    protected $casts = [
        'member_enlisted_date' => 'date',
        'guarantor1_enlisted_date' => 'date',
        'guarantor2_enlisted_date' => 'date',
    ];

    public function itemLoan()
    {
        return $this->belongsTo(ItemLoan::class);
    }

    public function approvedLoan()
    {
        return $this->belongsTo(ApprovedLoan::class);
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
}
