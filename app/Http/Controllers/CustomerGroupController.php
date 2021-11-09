<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerGroup;
use Illuminate\Http\Request;

class CustomerGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->view('customer-groups/index', [
            'customerGroups' => CustomerGroup::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('customer-groups/create', [
            'customers' => Customer::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:customer_groups,name|max:255',
            'customers.*' => 'sometimes|exists:customers,id'
        ]);

        $customerGroup = CustomerGroup::create($validated);
        $customerGroup->customers()->sync($request->customers);

        return redirect()->route('customer-groups.index')->with('success', 'Group stored')->with(['customerGroup' => $customerGroup]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerGroup  $customerGroup
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerGroup $customerGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomerGroup  $customerGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerGroup $customerGroup)
    {
        return response()->view('customer-groups/create', [
            'customerGroup' => $customerGroup,
            'customers' => Customer::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomerGroup  $customerGroup
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, CustomerGroup $customerGroup)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|unique:customer_groups,name,' . $customerGroup->id,
            'customers.*' => 'sometimes|exists:customers,id'
        ]);

        $customerGroup->update($validated);
        $customerGroup->customers()->sync($request->customers);

        return redirect()->route('customer-groups.index')->with('success', 'Group updated')->with(['customerGroup' => $customerGroup]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerGroup  $customerGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerGroup $customerGroup)
    {
        //
    }
}
