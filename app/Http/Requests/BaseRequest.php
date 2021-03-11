<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseRequest extends FormRequest
{
    public $errorBag = "default";

    abstract public function rules();

    abstract public function authorize();

    public function getId()
    {
        $className = class_basename($this->errorBag);
        return isset( $this->{$className}->id)? $this->{$className}->id : 0;
    }
}
