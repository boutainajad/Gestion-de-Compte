<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProfileController extends Controller
{

    public function me()
    {
        $user = JWTAuth::user();
        return response()->json([
            'message' => 'Profile fetched successfully',
            'user'    => $user
        ], 200);
    }


    public function update(Request $request)
    {
        $user = JWTAuth::user();

        $validator = Validator::make($request->all(), [
            'name'  => 'sometimes|string|max:255', 
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $user->id, 
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if ($request->has('name')) {
            $user->name = $request->name;
        }
        if ($request->has('email')) {
            $user->email = $request->email;
        }
        $user->save();

        return response()->json([
            'message' => 'Profile updated successfully',
            'user'    => $user
        ], 200);
    }


    public function updatePassword(Request $request)
    {
        $user = JWTAuth::user();

        $validator = Validator::make($request->all(), [
            'current_password'      => 'required|string',
            'new_password'          => 'required|string|min:8|confirmed', 
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'message' => 'Current password is incorrect'
            ], 422);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json([
            'message' => 'Password updated successfully'
        ], 200);
    }


    public function destroy()
    {
        $user = JWTAuth::user();

        $user->delete();

        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json([
            'message' => 'Account deleted successfully'
        ], 200);
    }
}