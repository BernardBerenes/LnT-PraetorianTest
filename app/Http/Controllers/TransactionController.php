<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function transaction_menu($id){
        $items = Item::findOrFail($id);

        return view('Transaction.transaction')->with('item', $items);
    }

    public function store_transaction(Request $request, $id){
        $request->validate([
            'amount' => 'required',
            'address' => 'required|min:10|max:100',
            'postal_code' => 'required|numeric|digits:5'
        ]);

        Transaction::create([
            'amount' => $request->amount,
            'address' => $request->address,
            'postal_code' => $request->postal_code
        ]);

        Item::findOrFail($id)->update([
            'quantity' => Item::findOrFail($id)->quantity - $request->amount
        ]);

        return redirect(route('item'));
    }
}
