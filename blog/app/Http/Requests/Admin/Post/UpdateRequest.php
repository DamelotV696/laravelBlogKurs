<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'content' => 'required|string',
            'preview_image' => 'nullable|file',
            'main_image' => 'nullable|file',
            'category_id' => 'required|integer|exists:categories,id',
            'tag_ids' => 'nullable|array',
            'tag_ids.*' => 'nullable|integer|exists:tags,id',
        ];
    }
    public function messages(): array
    {
        return [
            // --- Правила для 'title' ---
            'title.required' => 'Поле "Заголовок" обязательно для заполнения.',
            'title.string' => 'Поле "Заголовок" должно быть текстовым.',

            // --- Правила для 'content' ---
            'content.required' => 'Поле "Контент" обязательно для заполнения.',
            'content.string' => 'Поле "Контент" должно быть текстовым.',

            // --- Правила для 'preview_image' ---
            'preview_image.required' => 'Необходимо загрузить изображение для предварительного просмотра.',
            'preview_image.file' => 'Поле "Изображение для просмотра" должно быть файлом.',

            // --- Правила для 'main_image' ---
            'main_image.required' => 'Необходимо загрузить основное изображение.',
            'main_image.file' => 'Поле "Основное изображение" должно быть файлом.',

            // --- Правила для 'category_id' ---
            'category_id.required' => 'Необходимо выбрать категорию.',
            'category_id.integer' => 'Идентификатор категории должен быть целым числом.',
            'category_id.exists' => 'Выбранная категория не существует в базе данных.',

            // --- Правила для 'tag_ids' ---
            'tag_ids.array' => 'Поле "Теги" должно быть массивом.',

            // --- Правила для 'tag_ids.*' (для каждого элемента массива) ---
            'tag_ids.*.integer' => 'Каждый тег должен быть представлен целым числовым идентификатором.',
            'tag_ids.*.exists' => 'Один или несколько выбранных тегов не существуют в базе данных.',
        ];
    }
}
