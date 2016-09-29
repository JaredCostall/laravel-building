<?php

namespace Metrique\Building\Http\Requests;

use Metrique\Building\Http\Requests\Request;

class SectionRequest extends Request
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
            'title'=>'required|string|unique:building_page_sections,id,'.$this->get('id'),
            'slug'=>'nullable|string',
            'order'=>'integer',
            'params'=>'json',
            'building_pages_id'=>'required|exists:building_pages,id',
            'building_components_id'=>'required|exists:building_components,id',
        ];
    }
}
