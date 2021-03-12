<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Silber\Bouncer\BouncerFacade as Bouncer;

class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = 0;

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $id = Bouncer::role()->whereName($this->route('role'))->first()->id;
        }

        return [
            'name' => ['required', 'unique:roles,name,'.$id],
            'abilities' => ['required', 'array']
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function($validator) {
            if ($validator->errors()->count()) {
                if (!in_array($this->method(), ['PUT', 'PATCH'])) {
                    $validator->errors()->add('post', true);
                }
            }
        });
    }
}
