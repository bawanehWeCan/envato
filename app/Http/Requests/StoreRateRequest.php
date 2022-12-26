<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRateRequest extends FormRequest
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
            'user_id' => 'required|exists:App\Models\User,id',
			'by_id' => 'required|exists:App\Models\User,id',
			'extra' => 'nullable|string',
			'anonymous' => 'required|boolean',
			'avg' => 'required|numeric',
			'request' => 'nullable|string',
        ];
    }
}
