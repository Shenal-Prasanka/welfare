<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemLoan extends Model
{
    protected $fillable = [
        'application_id',
        'enlisted_no',
        'regiment_no',
        'rank',
        'name',
        'nic',
        'army_id',
        'office_address',
        'previous_unit',
        'welfare_membership',
        'welfare_membership_date',
        'bill_no',
        'bill_date',
        'enlisted_date',
        'retire_date',
        'required_welfare_item_category',
        'welfare_id',
        'item_name',
        'item_type',
        'model_no',
        'mobile_no',
        'land_no',
        'paying_installments',
        'deduct_time_period',
        'consent_agreement',
        'soldier_statement',
        'guarantor1_enlisted_no',
        'guarantor1_regiment_no',
        'guarantor1_rank',
        'guarantor1_name',
        'guarantor1_nic',
        'guarantor1_army_id',
        'guarantor1_office_address',
        'guarantor1_previous_unit',
        'guarantor1_welfare_membership',
        'guarantor1_enlisted_date',
        'guarantor1_retire_date',
        'guarantor2_enlisted_no',
        'guarantor2_regiment_no',
        'guarantor2_rank',
        'guarantor2_name',
        'guarantor2_nic',
        'guarantor2_army_id',
        'guarantor2_office_address',
        'guarantor2_previous_unit',
        'guarantor2_welfare_membership',
        'guarantor2_enlisted_date',
        'guarantor2_retire_date',
        'unit_id',
        'created_by',
        'status',
        'approved_by',
        'rejected_by',
        'rejection_reason',
        'approved_at',
        'rejected_at',
        'shop_coord_approved_by',
        'shop_coord_approved_at',
        'loan_checked',
        'membership_checked',
    ];

    protected $casts = [
        'welfare_membership_date' => 'date',
        'bill_date' => 'date',
        'enlisted_date' => 'date',
        'retire_date' => 'date',
        'guarantor1_enlisted_date' => 'date',
        'guarantor1_retire_date' => 'date',
        'guarantor2_enlisted_date' => 'date',
        'guarantor2_retire_date' => 'date',
        'consent_agreement' => 'boolean',
        'approved_at' => 'datetime',
        'rejected_at' => 'datetime',
    ];

    public function welfare()
    {
        return $this->belongsTo(Welfare::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function rejecter()
    {
        return $this->belongsTo(User::class, 'rejected_by');
    }

    public function shopCoordApprover()
    {
        return $this->belongsTo(User::class, 'shop_coord_approved_by');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($itemLoan) {
            if (empty($itemLoan->application_id)) {
                // Generate application ID: ILA-XXXXX
                $lastLoan = static::orderBy('id', 'desc')->first();
                $nextId = $lastLoan ? $lastLoan->id + 1 : 1;
                $itemLoan->application_id = 'ILA-' . str_pad($nextId, 5, '0', STR_PAD_LEFT);
            }
        });
    }
}
