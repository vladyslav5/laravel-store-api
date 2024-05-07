<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
//            'id'=>$this->id,
            'amount'=>$this->amount,
            'created_at'=>$this->created_at,
            'product'=> new ProductResource($this->product)
        ];
    }
}
