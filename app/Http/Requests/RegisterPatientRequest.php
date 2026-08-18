<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterPatientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'Sponsor_ID' => ['required'],
            'Patient_Name' => ['required', 'string', 'max:255'],
            'Date_Of_Birth' => ['required', 'string'],
            'Gender' => ['required', 'string'],
            'Visit_Type_ID' => ['required'],
            'Type_Of_Check_In' => ['required'],
            'branchId' => ['required'],
            'Employee_ID' => ['required'],
            'pf3' => ['nullable'],
            'Diceased' => ['nullable', 'string'],
            'Referral_Status' => ['nullable'],
        ];
    }
}
