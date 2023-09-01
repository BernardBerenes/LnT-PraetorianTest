<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show_category(){
        $categories = Category::all();

        return view('Category.show_category')->with('category', $categories);
    }

    public function add_category_menu(){
        return view('Category.add_category');
    }

    public function store_category(Request $request){
        $request->validate([
            'category' => 'required'
        ]);

        Category::create([
            'category_name' => $request->category
        ]);

        return redirect(route('category'));
    }

    public function edit_category_menu($id){
        $category = Category::findOrFail($id);

        return view('Category.edit_category')->with('category', $category);
    }

    public function update_category($id, Request $request){
        $request->validate([
            'category' => 'required'
        ]);

        $category = Category::findOrFail($id)->update([
            'category_name' => $request->category
        ]);

        return redirect(route('category'));
    }

    public function delete_category($id){
        Category::destroy($id);

        return redirect(route('category'));
    }
}
