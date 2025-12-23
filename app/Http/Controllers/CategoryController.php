<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorys = Category::where('is_deleted', 0)->get(); // Return all non-deleted records
        return view('categorys.index', compact('categorys'));
    }

    //Active Deactive section
    public function active($categoryId)
    {
       $category = Category::find($categoryId); // Find the rank by ID
        if ($category)
         {
            if($category->active)
                {
                    $category->active = 0;
                }
            else
                {
                    $category->active = 1; 
                }
            $category->save(); // Save the changes
         }
            return back()->with('info', 'category created successfully.');       
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'category' => 'required|string|unique:categorys,category',
            'description' => 'nullable|string',
        ]);

        $category = Category::create([
            'category' => $request->category,
            'description' => $request->description,
            'active' => 1,     
        ]);

        // Send notification to all staff
        NotificationService::categoryAdded($category->category);

        return redirect()->route('categorys.index')->with('success', 'category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category' => 'required|string|unique:categorys,category',
            'description' => 'nullable|string',
        ]);

        $category = Category::find($id);

        $category->category = $request->category;
        $category->description = $request->description;
        $category->active = 1;
        $category->save();

        return redirect()->route('categorys.index')->with('warning', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->is_deleted = 1;
        $category->save();

    return redirect()->route('categorys.index')->with('error', 'Category deleted successfully!');
    }
}
