<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Form;

class FormSeeder extends Seeder
{
    public function run()
    {
        Form::create([
            'name' => 'Customer Form',
            'schema' => [
                'fields' => [
                    [
                        'key' => 'customer_type',
                        'type' => 'select',
                        'required' => true,
                        'options' => ['individual', 'company']
                    ],
                    [
                        'key' => 'company_name',
                        'type' => 'text',
                        'required' => true,
                        'visible_if' => [
                            'field' => 'customer_type',
                            'operator' => 'equals',
                            'value' => 'company'
                        ]
                    ],
                    [
                        'key' => 'age',
                        'type' => 'number',
                        'required' => true
                    ],
                    [
                        'key' => 'discount',
                        'type' => 'number',
                        'required' => false
                    ]
                ]
            ]
        ]);
    }
}
