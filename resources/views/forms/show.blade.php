@extends('layout.app')

@section('content')


<div class="form-container">
    <h1>{{ $form->name }}</h1>

    <form id="dynamicForm" method="POST" action="/forms/{{ $form->id }}">
        @csrf

        @foreach($form->schema['fields'] as $field)
            <div class="mb-3 form-group" data-key="{{ $field['key'] }}">
                <label class="form-label fw-bold">{{ ucwords(str_replace('_', ' ', $field['key'])) }}</label>

                @if($field['type'] === 'select')
                    <select name="{{ $field['key'] }}" class="form-select">
                        <option value="" selected disabled>اختر...</option>
                        @foreach($field['options'] as $option)
                            <option value="{{ $option }}">{{ ucwords($option) }}</option>
                        @endforeach
                    </select>
                @else
                    <input type="{{ $field['type'] }}" name="{{ $field['key'] }}" class="form-control" placeholder="أدخل {{ str_replace('_', ' ', $field['key']) }}">
                @endif

                <div class="error" data-error="{{ $field['key'] }}"></div>
            </div>
        @endforeach

        <button type="submit" class="btn btn-submit">Submit</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    
    function toggleCompanyField() {
        const customerType = $('[name="customer_type"]').val();
        if (customerType === 'company') {
            $('[data-key="company_name"]').show();
        } else {
            $('[data-key="company_name"]').hide();
        }
    }

    toggleCompanyField();
    $('[name="customer_type"]').change(toggleCompanyField);

    
    $('#dynamicForm').on('submit', function(e) {
        e.preventDefault();

        $('.error').text(''); 

        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                alert('Form submitted successfully!');
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    for (const key in errors) {
                        $(`[data-error="${key}"]`).text(errors[key][0]);
                    }
                } else {
                    console.error(xhr.responseText);
                }
            }
        });
    });
});
</script>
@endsection
