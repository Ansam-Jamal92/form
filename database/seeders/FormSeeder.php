<?php

namespace Database\Seeders;
use App\Models\Form;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
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
                    ]
                ]
            ]
        ]);
    
    }
}
