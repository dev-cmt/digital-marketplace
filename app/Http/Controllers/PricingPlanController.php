<?php

namespace App\Http\Controllers;

use App\Models\PricingPlan;
use Illuminate\Http\Request;

class PricingPlanController extends Controller
{
    public function index()
    {
        $plans = PricingPlan::orderBy('order')->get();
        return view('backend.pricing_plans.index', compact('plans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'monthly_price' => 'nullable|numeric|min:0',
            'annual_price' => 'nullable|numeric|min:0',
            'order' => 'nullable|integer',
        ]);

        $plan = new PricingPlan();
        $plan->name = $request->name;
        $plan->description = $request->description;
        $plan->monthly_price = $request->monthly_price ?? 0;
        $plan->annual_price = $request->annual_price ?? 0;
        
        $features = [];
        if ($request->has('features') && is_array($request->features)) {
            $features = array_values(array_filter($request->features, function($value) {
                return !is_null($value) && $value !== '';
            }));
        }
        $plan->features = $features;
        
        $plan->is_popular = $request->has('is_popular');
        $plan->is_active = $request->has('is_active');
        $plan->order = $request->order ?? 0;
        $plan->save();

        return redirect()->back()->with('success', 'Pricing Plan created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'monthly_price' => 'nullable|numeric|min:0',
            'annual_price' => 'nullable|numeric|min:0',
            'order' => 'nullable|integer',
        ]);

        $plan = PricingPlan::findOrFail($id);
        $plan->name = $request->name;
        $plan->description = $request->description;
        $plan->monthly_price = $request->monthly_price ?? 0;
        $plan->annual_price = $request->annual_price ?? 0;
        
        $features = [];
        if ($request->has('features') && is_array($request->features)) {
            $features = array_values(array_filter($request->features, function($value) {
                return !is_null($value) && $value !== '';
            }));
        }
        $plan->features = $features;
        
        $plan->is_popular = $request->has('is_popular');
        $plan->is_active = $request->has('is_active');
        $plan->order = $request->order ?? 0;
        $plan->save();

        return redirect()->back()->with('success', 'Pricing Plan updated successfully.');
    }

    public function destroy($id)
    {
        $plan = PricingPlan::findOrFail($id);
        $plan->delete();
        return redirect()->back()->with('success', 'Pricing Plan deleted successfully.');
    }
}
