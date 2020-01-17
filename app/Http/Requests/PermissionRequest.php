<?php


namespace AttendanceSystem\Http\Requests;


class PermissionRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:50',
            'slug' => 'required|min:3|max:50',
        ];
    }
}
