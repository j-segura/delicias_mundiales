<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $countries = Country::orderBy('created_at', 'desc')->paginate(5);
            return Inertia::render('Admin/Countries/Index', compact('countries'));

        } catch (\Exception $ex) {

            $message = 'Error en el método' . __METHOD__ . ' / ' . $ex;
            Log::error($message);
            return false;

        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Countries/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:countries,name'
            ]);

            Country::create($validated);

            return redirect()->route('countries.index');

        } catch (\Exception $ex) {
            $message = 'Error en el método ' . __METHOD__ . ' / ' . $ex->getMessage();
            Log::error($message);

            return response()->json([
                'success' => false,
                'message' => 'Error al crear el pais',
                'error' => $message
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Country $country)
    {
        return Inertia::render('Admin/Countries/Edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Country $country)
    {
        try {

            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:countries,name'
            ]);

            $country->update($validated);
            return redirect()->route('countries.index');

        } catch (\Exception $ex) {

            $message = 'Error en el método' . __METHOD__ . ' / ' . $ex;
            Log::error($message);
            return false;

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        try {

            $country->delete();
            return redirect()->route('countries.index');

        } catch (\Exception $ex) {

            $message = 'Error en el método' . __METHOD__ . ' / ' . $ex;
            Log::error($message);
            return false;

        }
    }
}
