<?php
namespace App\Registrar\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterDomainRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'domain' => ['required','regex:/^[a-z0-9-]+\.[a-z]{2,}$/i'],
            'period' => ['required','integer','min:1','max:10'],
            'contacts.admin' => ['required','integer','exists:registrar_contacts,id'],
            'nameservers' => ['required','array','min:2','max:13'],
            'nameservers.*' => ['distinct','regex:/^[a-z0-9.-]+$/i']
        ];
    }
}
