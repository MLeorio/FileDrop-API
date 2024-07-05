<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreDocumentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "document_label" => "required|string",
            // "document_url"=> "required|string",
            // "document_type"=> "required|string",
            "document_description"=> "string",
            "document_file"=> "required|mimes:png,jpg,pdf,doc,docs,xls,pptx|max:2048",
            // "document_size"=> "required|numeric",
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Erreur de validation des données',
            'data'      => $validator->errors()
        ]));
    }
}
