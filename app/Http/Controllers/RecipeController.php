<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Recipe;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $recipes = Recipe::all()->paginate(5);
        return response()->json(['staus' => 200,'data' => $recipes]);
    }

    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $request->validate([
            'name' => 'required',
            'preptime' => 'required',
            'difficulty' => 'required',
            'vegetarian' => 'required',
            'rating' => 'required',
        ]);
 
        $recipes = Recipe::create($request->all());
        return response()->json(['staus' => 200,'data' => $recipes]);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $recipes=Recipe::find($id);
       // $recipes->update($request->all());
       if (is_null($recipes)) {
            return $this->sendError('Recipe not found.');
        }
        return response()->json(['staus' => 200,'data' => $recipes,'message' => "recipe viewed successfully"]);
       
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      
        $request->validate([
            'name' => 'required',
            'preptime' => 'required',
            'difficulty' => 'required',
            'vegetarian' => 'required',
            'rating' => 'required',
        ]);
        $recipes=Recipe::find($id);
        if (is_null($recipes)) {
            return $this->sendError('Recipe not found.');
        }
        $recipes->update($request->all());
 
        return response()->json(['staus' => 200,'data' => $recipes,'message' => "recipe updated successfully"]);
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $recipes=Recipe::find($id);
        if (is_null($recipes)) {
            return $this->sendError('Recipe not found.');
        }
        $recipes->delete();
        return response()->json(['staus' => 200,'data' => $recipes,'message' => "recipe deleted successfully"]);
       
    }
}
