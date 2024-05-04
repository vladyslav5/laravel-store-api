<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use function Sodium\add;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return OrderResource::collection(Order::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
        $validated = $request->validated();
        $user = request()->user();

        $newOrder = new Order([
           'user_id'=>$user->id
        ]);
        $newOrder->save();
        foreach ($validated['products'] as $product) {
            OrderProduct::create([
                'product_id'=>$product['id'],
                'amount'=>$product['amount'],
                'order_id'=>$newOrder['id']
            ]);
        }

        return new OrderResource($newOrder);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new OrderResource(Order::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
