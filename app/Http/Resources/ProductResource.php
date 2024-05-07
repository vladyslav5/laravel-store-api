<?php

namespace App\Http\Resources;

use App\Models\Category;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $cc = $request->query->get('currency');
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'description'=>$this->description,
            'price'=> $this->when(true,function () use ( $cc ) {
                if(is_null( $cc )){
                    return 0;
                }
                else{
                    $price = $this->price * Currency::where('cc',$this->currency)->firstOrFail()->rate / Currency::where('cc',$cc)->firstOrFail()->rate;
                    return round( $price ,floor(log10($price)));
                }
            }),
            'category'=> new CategoryResource($this->category),
            'created_at'=>$this->created_at,
            'currency'=> $this->when(true,function () use ($cc) {
                if(is_null($cc)){
                    return $this->currency;
                }
                else{
                    return $cc;
                }
            }),
        ];
    }
}
