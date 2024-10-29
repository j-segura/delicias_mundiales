<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Dish\StoreRequest;
use App\Models\Category;
use App\Models\Country;
use App\Models\Dish;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $dishes = Dish::orderBy('created_at', 'desc')->paginate(10);
            return Inertia::render('Admin/Dishes/Index', compact('dishes'));

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
        try {

            $categories = Category::select('id', 'name')->get();
            $countries = Country::select('id', 'name')->get();
            return Inertia::render('Admin/Dishes/Create', compact('countries', 'categories'));

        } catch (\Exception $ex) {

            $message = 'Error en el método' . __METHOD__ . ' / ' . $ex;
            Log::error($message);
            return false;

        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {
            $data = $request->validated();

            // Handle image upload
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('dishes', 'public');
                $data['image'] = asset('storage/' . $imagePath);
            }

            // Create new Dish model
            $dish = new Dish();
            $dish->name = $data['name'];
            $dish->description = $data['description'];
            $dish->image = $data['image'];
            $dish->url_video = $data['url_video'];
            $dish->ingredients = $data['ingredients'];
            $dish->step_by_step = $data['step_by_step'];
            $dish->country_id = $data['country_id']['id'];

            // Save the Dish model
            $dish->save();

            // Attach categories
            $data['categories'] = array_column($data['categories'], 'id');
            if ($data['categories']) {
                $dish->categories()->attach($data['categories']);
            }

            // Redirect to the dishes index page
            return redirect()->route('dishes.index');
        } catch (\Exception $ex) {
            $message = 'Error in method ' . __METHOD__ . ' / ' . $ex;
            Log::error($message);
            return false;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Dish $dish)
    {
        try {

            $dish = Dish::with('categories:id,name', 'country:id,name')->where('id', $dish->id)->first();
            $moreDishes = Dish::take(4)->get();
            $authUser = auth()->user()->id;

            return Inertia::render('Dishes/Show', [
                'dishes' => $dish,
                'moreDishes' => $moreDishes,
                'authUser' => $authUser,
            ]);

        } catch (\Exception $ex) {

            $message = 'Error en el método' . __METHOD__ . ' / ' . $ex;
            Log::error($message);
            return false;

        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dish $dish)
    {
        try {

            $dish = Dish::with('country:id,name', 'categories:id,name')->where('id', $dish->id)->first();
            $categories = Category::select('id', 'name')->get();
            $countries = Country::select('id', 'name')->get();
            return Inertia::render('Admin/Dishes/Edit', [
                'dish' => $dish,
                'categories' => $categories,
                'countries' => $countries
            ]);

        } catch (\Exception $ex) {

            $message = 'Error en el método' . __METHOD__ . ' / ' . $ex;
            Log::error($message);
            return false;

        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Dish $dish)
    {
        try {

            $data = $request->validated();

            $dish = Dish::with('categories')->where('id', $dish->id)->first();

            if ($request->hasFile('image')) {
                // Delete old Image if exists
                if ($dish->image) {
                    Storage::delete($dish->image);
                }

                $imagePath = $request->file('image')->store('dishes', 'public');
                $data['image'] = asset('storage/' . $imagePath);
            } else {
                $data['image'] = $dish->image;
            }

            $dish->name = $data['name'];
            $dish->description = $data['description'];
            $dish->image = $data['image'];
            $dish->url_video = $data['url_video'];
            $dish->ingredients = $data['ingredients'];
            $dish->step_by_step = $data['step_by_step'];
            $dish->country_id = $data['country_id']['id'];

            $dish->save();

            $data['categories'] = array_column($data['categories'], 'id');

            if ($data['categories']) {
                $dish->categories()->detach($dish->categories);
                $dish->categories()->attach($data['categories']);
            }

            return redirect()->route('dishes.index');

        } catch (\Exception $ex) {

            $message = 'Error en el método' . __METHOD__ . ' / ' . $ex;
            Log::error($message);
            return false;

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dish $dish)
    {
        try {

            $dish->delete();
            return redirect()->route('dishes.index');

        } catch (\Exception $ex) {

            $message = 'Error en el método' . __METHOD__ . ' / ' . $ex;
            Log::error($message);
            return false;

        }
    }
}
