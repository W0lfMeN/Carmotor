<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'apellidos'=>['required', 'string'],

            'calle' =>['required', 'string', 'max:255'],
            'cp' =>['required', 'digits:5'],
            'poblacion' =>['required', 'string', 'max:255'],
            'provincia' =>['required', 'string', 'max:255'],

            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'apellidos'=>$input['apellidos'],
            'email' => $input['email'],
            'direccion'=> $input['calle'].", ".$input['cp'].", ".$input['poblacion'].", ".$input['provincia'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
