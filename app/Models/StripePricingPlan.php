<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StripePricingPlan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['product_id', 'stripe_price_id', 'name', 'price', 'currency', 'billing_period'];

    public function product()
    {
        return $this->belongsTo(StripeProduct::class)->withTrashed();
    }

    public function features()
    {
        return $this->belongsToMany(PricingPlanFeature::class, 'pricing_plan_feature_assignments', 'pricing_plan_id', 'feature_id')
            ->withPivot('is_available') // Include 'is_available' in the pivot data
            ->withTimestamps(); // To keep track of when features were assigned to plans
    }
}
