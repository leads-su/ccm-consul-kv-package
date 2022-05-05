<?php

namespace ConsulConfigManager\Consul\KeyValue\Http\Requests\KeyValue;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class KeyValueCreateUpdateRequest
 * @package ConsulConfigManager\Consul\KeyValue\Http\Requests\KeyValue
 */
class KeyValueCreateUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules(): array
    {
        return [
            'path'          =>  ['required', 'string'],
            'value'         =>  ['required', 'array'],
            'value.type'    =>  ['required', 'string'],
            'value.value'   =>  ['required'],
        ];
    }
}
