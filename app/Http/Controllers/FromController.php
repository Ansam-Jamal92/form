<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;

class FromController extends Controller
{
    public function show($id){
        $form =Form::findOrFail($id);
        return view('forms.show',compact('form'));
    }

    public function submit(Request $request, $id)
{
    $form = Form::findOrFail($id);
    $schema = $form->schema;

    $rules = [];
    $messages = [];

    foreach ($schema['fields'] as $field) {
        if ($field['required'] && $this->isVisible($field, $request->all())) {
            $rules[$field['key']] = 'required';
            $messages[$field['key'].'.required'] = 'هذا الحقل مطلوب';
        }
    }

    $validated = $request->validate($rules, $messages);

    return response()->json($validated);
}

private function isVisible($field, $data)
{
    if (!isset($field['visible_if'])) return true;

    return $data[$field['visible_if']['field']] 
           == $field['visible_if']['value'];
}


}
