<?php


namespace AttendanceSystem\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends  FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'quantity' => 'required|min:1|max:5000',
        ];
    }
}
