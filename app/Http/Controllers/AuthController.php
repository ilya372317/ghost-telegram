<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

/**
 * Class AuthController
 * @pakege App\Http\Controllers
 *
 * @author Otinov Ilya
 */
class AuthController extends Controller
{
    /**
     * @param AuthRequest $request
     * @return mixed
     * @throws ValidationException
     */
    public function getToken(AuthRequest $request): mixed
    {
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $user->createToken($request->device_name)->plainTextToken;
    }
}
