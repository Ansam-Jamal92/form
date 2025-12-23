@extends('layout.app')

@section('content')


<div class="form-container">
    <h1>{{ $form->name }}</h1>
    <form id="dynamicForm" method="POST" action="/forms/{{ $form->id }}">
        @csrf

        @foreach($form->schema['fields'] as $field)
            <div class="mb-3 form-group" data-key="{{ $field['key'] }}">
                <label class="form-label">{{ ucwords(str_replace('_', ' ', $field['key'])) }}</label>

                @if($field['type'] === 'select')
                    <select name="{{ $field['key'] }}" class="form-select">
                        <option value="" disabled selected>اختر...</option>
                        @foreach($field['options'] as $option)
                            <option value="{{ $option }}"
                                @if(isset($field['default']) && $field['default'] === $option) selected @endif
                            >{{ ucwords($option) }}</option>
                        @endforeach
                    </select>
                @else
                    <input type="{{ $field['type'] }}" 
                           name="{{ $field['key'] }}" 
                           class="form-control" 
                           placeholder="أدخل {{ str_replace('_', ' ', $field['key']) }}"
                           value="{{ $field['default'] ?? '' }}">
                @endif

                <div class="error" data-error="{{ $field['key'] }}"></div>
                <div class="warning" data-warning="{{ $field['key'] }}"></div>
            </div>
        @endforeach

        <div class="text-center">
            <button type="submit" class="btn-submit">Submit</button>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {

    function updateConditionalFields() {
        const customerType = $('[name="customer_type"]').val();
        const age = parseInt($('[name="age"]').val()) || 0;
        const discount = parseFloat($('[name="discount"]').val()) || 0;

        if (customerType === 'company') {
            $('[data-key="company_name"]').show();
        } else {
            $('[data-key="company_name"]').hide();
        }

        if (age > 0 && age < 18) {
            $('[name="discount"]').prop('disabled', true);
        } else {
            $('[name="discount"]').prop('disabled', false);
        }

        if (discount > 20) {
            $('[data-warning="discount"]').text('⚠️ Discount exceeds 20!');
        } else {
            $('[data-warning="discount"]').text('');
        }
    }


    function getFocusableFields() {
        return $('#dynamicForm')
            .find('input, select, button')
            .filter(':visible:not(:disabled)');
    }

    $('#dynamicForm').on('keydown', 'input, select', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();

            const fields = getFocusableFields();
            const index = fields.index(this);

            if (index > -1 && index < fields.length - 1) {
                fields.eq(index + 1).focus();
            } else {
                $('#dynamicForm').submit();
            }
        }
    });


    $('[name="customer_type"], [name="age"], [name="discount"]').on('input change', function() {
        updateConditionalFields();
    });

    updateConditionalFields();


    $('#dynamicForm').on('submit', function(e) {
        e.preventDefault();

        $('.error').text('');
        $('.warning').text('');

        const formData = {};
        let hasError = false;

        $('#dynamicForm').find('input, select').each(function() {
            const $el = $(this);
            const key = $el.attr('name');

            if ($el.is(':visible') && !$el.is(':disabled')) {
                const value = $el.val();
                formData[key] = value;

                if (
                    key === 'company_name' &&
                    $('[data-key="company_name"]').is(':visible') &&
                    (!value || value.trim() === '')
                ) {
                    $(`[data-error="${key}"]`).text('هذا الحقل مطلوب');
                    hasError = true;
                }
            }
        });

        if (hasError) return;

        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: formData,
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
