<?php

namespace App\Http\Requests;

use App\Models\Trip;
use Illuminate\Foundation\Http\FormRequest;

class ReserveRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'seat_id' => 'required|exists:seats,id',
            'bus_id' => 'required|exists:buses,id',
            'trip_id' => 'required|exists:trips,id',
            'user_id' => 'required|exists:users,id',
            'from_stop_number' => 'required',
            'to_stop_number' => 'required',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!Trip::where('bus_id', $this->bus_id)->find($this->trip_id)) {
                $validator->errors()->add('field', 'Something is wrong with this field!');
            }
        });
    }
}
