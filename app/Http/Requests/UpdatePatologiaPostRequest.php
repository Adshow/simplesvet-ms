<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class UpdatePatologiaPostRequest extends FormRequest
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
            'id' => 'required|exists:App\Models\Patologia,id',
            'user_id' => 'required|exists:App\Models\User,id',
            'nome' => 'required|max:255',
            'descricao' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'O id da patologia é requerido',
            'id.exists' => 'O id da patologia é inválido',
            'user_id.required' => 'O id do usuario é requerido',
            'user_id.exists' => 'O id do usuario é inválido',
            'nome.required' => 'É requerido um nome para a Patologia',
            'nome.max' => 'Nome da patologia excedeu o tamanho máximo',
            'descricao.required' => 'É requerido uma descrição para a Patologia',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json(['errors' => $errors,
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
