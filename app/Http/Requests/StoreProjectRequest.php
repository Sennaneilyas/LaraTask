<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ProjectColor;
use App\Rules\ValidProjectSlug;

class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user() && auth()->user()->can('create', Project::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $project = $this->route('project');
        return [
            'title' => ['required','string','min:3','max:255'],
            'slug' => [
                'required',
                'alpha_dash',
                Rule::unique('projects', 'slug')->where('user_id', auth()->id())
                    ->ignore($project?->id),
                new ValidProjectSlug
            ],
            'description' => ['nullable', 'string', 'max:5000'],
            'status' => ['required', 'in:active,archived'],
            'color' => ['nullable', new ProjectColor]
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The project title is required',
            'title.min' => 'The project title must be at least 3 characters long',
            'title.max' => 'The project title must be at most 255 characters long',
            'slug.required' => 'The project slug is required',
            'slug.alpha_dash' => 'The project slug must contain only letters, numbers, and dashes',
            'slug.unique' => 'Slug already taken',
            'description.max' => 'The project description must be at most 5000 characters long',
            'status.in' => 'The project status must be either active or archived'
        ];
    }

    /**
     * The role of this method is to normalize the incoming data before validation.  
     * this method is called before the validation rules are applied to the request data.
     * it uses the str()->slug() helper to generate a slug from the title.
     * it also sets the status to 'active' if it is not provided.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            //if the slug is not provided, it will be generated from the title.
            'slug' => $this->slug ?? Str::slug($this->title),
            //if the status is not provided, it will be set to active.
            'status' => $this->status ?? 'active'
        ]);
    }
}
