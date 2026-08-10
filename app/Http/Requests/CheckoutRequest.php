<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => ['required','string','max:255'],
            'email' => ['required','email','max:255'],
            'phone' => ['required','string','max:30'],
            'address_line1' => ['required','string','max:255'],
            'address_line2' => ['nullable','string','max:255'],
            'city' => ['required','string','max:100'],
            'state' => ['nullable','string','max:100'],
            'postal_code' => ['required','string','max:20'],
            'country' => ['required','string','max:100'],
            'payment_method' => ['required','in:credit_card,paypal,cod'],

            // credit card fields required only when credit_card is chosen
            'card_number' => ['required_if:payment_method,credit_card','digits_between:12,19'],
            'card_cvc' => ['required_if:payment_method,credit_card','digits_between:3,4'],
            'card_exp_month' => ['required_if:payment_method,credit_card','integer','between:1,12'],
            'card_exp_year' => ['required_if:payment_method,credit_card','integer','min:'.date('Y')],
        ];
    }

    public function messages(): array
    {
        return [
            'payment_method.in' => 'Please select a valid payment method.',
            'card_number.required_if' => 'Card number is required when paying by credit card.',
        ];
    }
}
