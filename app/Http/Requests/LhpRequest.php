<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LhpRequest extends FormRequest
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
        $rules = [
            'hasil_pemeriksaan' => 'required'
        ];
        $photos = count($request->input('photos'));

        dd($photos);
        foreach(range(0, $photos) as $index) {
            $rules['photos.' . $index] = 'image|mimes:jpg,jpeg,bmp,png|max:2000';
        }

        return $rules;
    }
}
