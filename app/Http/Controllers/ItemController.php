<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function show_item(){
        $items = Item::all();

        return view('Item.show_item')->with('item', $items);
    }

    public function add_item_menu(){
        $category = Category::all();

        return view('Item.add_item')->with('categories', $category);
    }

    public function store_item(Request $request){
        $request->validate([
            'name' => 'required|string|min:5|max:80',
            'category' => 'required',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'image' => 'required|file|mimes:jpg,png,jpeg,svg'
        ]);

        $extension = $request->file('image')->getClientOriginalExtension();
        $file_name = $request->name.'.'.$extension;
        $request->file('image')->storeAs('/public/Item/', $file_name);

        Item::create([
            'category_id' => $request->category,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'image' => $file_name
        ]);

        return redirect(route('item'));
    }

    public function edit_item_menu($id){
        $items = Item::findOrFail($id);
        $category = Category::all();

        return view('Item.edit_item')->with('item', $items)->with('categories', $category);
    }

    public function update_item($id, Request $request){
        $request->validate([
            'name' => 'required|string|min:5|max:80',
            'category' => 'required',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'image' => 'required|mimes:jpg,png,jpeg,svg'
        ]);

        $extension = $request->file('image')->getClientOriginalExtension();
        $file_name = $request->name.'.'.$extension;
        $request->file('image')->storeAs('/public/Item/', $file_name);

        $items = Item::findOrFail($id)->update([
            'category_id' => $request->category,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'image' => $file_name
        ]);

        return redirect(route('item'));
    }

    public function delete_item($id){
        Item::destroy($id);

        return redirect(route('item'));
    }
}
