<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Recipe;
use Validator;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $recipes = Recipe::all();
        if (is_null($recipes->first())) {
            return response()->json([
                'status' => 'failed',
                'message' => 'No recipes found!',
            ], 200);
        }

        return response()->json(['staus' => 200,'data' => $recipes]);
    }

    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string',
            'preptime' => 'required',
            'difficulty' => 'required|integer',
            'vegetarian' => 'required|boolean',
            'rating' => 'required|integer',
        ]);

        if($validate->fails()){  
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Error!',
                'data' => $validate->errors(),
            ], 403);
        }
       
        
 
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
        if (is_null($recipes->first())) {
            return response()->json([
                'status' => 'failed',
                'message' => 'No recipes found!',
            ], 200);
        }
        return response()->json(['staus' => 200,'data' => $recipes,'message' => "recipe viewed successfully"]);
       
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      
        $validate = Validator::make($request->all(), [
            'name' => 'required|string',
            'preptime' => 'required',
            'difficulty' => 'required|integer',
            'vegetarian' => 'required|boolean',
            'rating' => 'required|integer',
        ]);

        if($validate->fails()){  
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Error!',
                'data' => $validate->errors(),
            ], 403);
        }

        $recipes=Recipe::find($id);
        if (is_null($recipes->first())) {
            return response()->json([
                'status' => 'failed',
                'message' => 'No recipes found!',
            ], 200);
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
        if (is_null($recipes->first())) {
            return response()->json([
                'status' => 'failed',
                'message' => 'No recipes found!',
            ], 200);
        }
        $recipes->delete();
        return response()->json(['staus' => 200,'data' => $recipes,'message' => "recipe deleted successfully"]);
       
    }
}
