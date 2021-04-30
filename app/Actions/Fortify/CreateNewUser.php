<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Image;

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
        // dd($input);
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();
    //    dd(request()->all());
        if(request()->has('avatar')){
            return User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'type' => 'sched',
                'password' => Hash::make($input['password']),
                'avatar' => request()->avatar->store('/uploads/avatars/', 'public'),
            ]);
        } else {

            return User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'type' => 'sched',
                'password' => Hash::make($input['password']),
            ]);
        }
    }
}
