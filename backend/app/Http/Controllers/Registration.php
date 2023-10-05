<?php

namespace App\Http\Controllers;

use App\Dto\RegistrationDto;
use App\Models\User;
use Illuminate\Http\Request;
use \Hash;
use \Illuminate\Support\Str;

trait Registration
{
    /**
     * @param  Request  $request
     * @param  int      $datasourceId
     * @return RegistrationDto
     */
    public function registerUser(Request $request, int $datasourceId = 1): RegistrationDto
    {
        $validatedData = $request->safe()->only(['email']);
        $password = Str::password(10);

        $user = User::create([
            'email' => $validatedData['email'],
            'password' => Hash::make($password),
            'datasource_id' => $datasourceId
        ]);
        $registrationDto = new RegistrationDto();
        $registrationDto->user = $user;
        $registrationDto->password = $password;
        $registrationDto->token = $user->createToken('auth_token');

        return $registrationDto;
    }
}