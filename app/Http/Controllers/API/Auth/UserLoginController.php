<?php

namespace App\Http\Controllers\API\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request) {
        if ($request->has(['mobile', 'password'])) {
            $user = User::query()
                ->where('mobile', $request->all()['mobile'])->first();
            if ($user) {
                if (Hash::check($request->all()['password'], $user->password)) {
                    return response()->json([
                        'status'    => [
                            'Code'      => 200,
                            'Message'   => 'Login successfully',
                            'Results'   => [
                                'id'            => $user->id,
                                'name'          => $user->name,
                                'email'         => $user->email,
                                'role'          => $user->role_id == 15 ? "Viewer" : "Admin",
                                'permission'    => $user->status ? "Yes" : "No", /* //  Note : Waiting for confirmation //  */
                            ]
                        ]
                    ]);
                }
            }

            return response()->json([
                'status'    => [
                    'Code'      => 403,
                    'Message'   => 'Invalid credentials',
                    'Results'   => []
                ]
            ]);
        }
        return response()->json([
            'status'    => [
                'Code'      => 403,
                'Message'   => 'Invalid request',
                'Results'   => [],
            ]
        ]);
    }
}
