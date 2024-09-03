<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PricingPlanFeature extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'description'];

    /**
     * The pricing plans that belong to the feature.
     */
    public function pricingPlans()
    {
        return $this->belongsToMany(StripePricingPlan::class, 'pricing_plan_feature_assignments', 'pricing_plan_id', 'feature_id')
            ->withPivot('is_available')
            ->withTimestamps(); // To keep track of when features were assigned to plans
    }
}
