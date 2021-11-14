<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = 0;

        if(in_array($this->method(), ['PUT', 'PATCH'])) {
            $id = $this->route('product')['id'];
        }

        return [
            'name' => ['required', 'string', "unique:products,name,$id", 'max:255'],
            'unit_price' => ['required', 'numeric'],
            'quantity' => ['required', 'integer'],
            'total_cost' => ['required', 'numeric'],
            'description' => ['nullable', 'string'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function($validator) {
            if($validator->errors()->count()) {
                if(!in_array($this->method(), ['PUT', 'PATCH'])) {
                    $validator->errors()->add('post', true);
                }
            }
        });
    }
}
