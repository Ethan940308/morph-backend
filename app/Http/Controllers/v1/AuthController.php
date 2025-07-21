<?php

namespace App\Http\Controllers\v1;

use App\Enums\AuthGuard;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function index(){
        return success_response(new UserResource(current_user()));
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return error_response($validator->errors()->first());
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return error_response('Invalid Credentials');
        }

        $token = $user->createToken(AuthGuard::USER->value)->plainTextToken;

        return success_response([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => config('sanctum.expiration'),
            'user' => new UserResource($user)
        ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'max:20'],
            'email' => ['required', 'email', Rule::unique('users','email'), 'max:50'],
            'password' => ['required', 'confirmed', 'max:50']
        ]);

        if ($validator->fails()) {
            return error_response($validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            $record = User::create($request->only(['name', 'email', 'password']));

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return error_response($e->getMessage());
        }

        return success_response(new UserResource($record));
    }
}
