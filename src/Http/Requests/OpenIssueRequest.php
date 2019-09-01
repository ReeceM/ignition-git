<?php
namespace ReeceM\GitTab\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OpenIssueRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'git'   => 'required',
            'title' => 'required',
            'body'  => 'required'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'A title is required',
            'body.required'  => 'A message is required',
        ];
    }
}