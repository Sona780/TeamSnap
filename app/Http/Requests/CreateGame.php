<?php

namespace TeamSnap\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateGame extends FormRequest
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
        return [
            'date' => 'required | date',
            'hour' => 'required | digits_between: 1, 12 | numeric',
            'minute' => 'required | numeric | digits_between: 0, 60',
            'opponent' => 'required | string',
            'location' => 'required | string',
            'location_detail' => 'required | string'
        ];
    }
}
