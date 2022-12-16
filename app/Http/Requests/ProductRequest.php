<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title'       => 'required|max:255',
            'description' => 'nullable|max:5000',
            'price'       => 'required|numeric',
            'image'       => 'nullable|image|mimes:png,jpg,jpeg,gif,webp|max:2048',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     * Custom validation message
     */
    public function messages(): array
    {
        return [
            'title.required'  => 'Non du produit obligatoire',
            'title.max'       => '255 characters maximum, pour le nom du produit',
            'description.max' => 'Please give product description maximum of 5000 characters',
            'price.required'  => 'Prix du produit obligatoire',
            'price.numeric'   => 'Prix du produit doit etre en format numeric',
            'image.image'     => 'Produit image en format image seulement',
            'image.max'       => 'Product image max 2MB is allowed',
        ];
    }
}
