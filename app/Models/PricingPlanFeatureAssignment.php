<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PricingPlanFeatureAssignment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['pricing_plan_id', 'feature_id', 'is_available'];
}
