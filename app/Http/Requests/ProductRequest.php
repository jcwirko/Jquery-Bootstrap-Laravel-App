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
            'code' => ['required', 'string', "unique:products,code,$id"],
            'description' => ['required', 'string'],
            'family' => ['nullable', 'string'],
            'group' => ['nullable', 'string'],
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
