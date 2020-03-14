<?php

namespace App\Http\Controllers\API;

use App\Mail\TestMail;
use App\Orange\Helpers\UserHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class RegisterUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */
    public function mailTest() {
        return Mail::to('shahrukhdev52@gmail.com')->send(new TestMail('hello world'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function store(Request $request) {
        if ($request->has(['name', 'email', 'mobile', 'password'])) {
            try {
                $user = (new UserHelper())->create($request->only(['name', 'email', 'password', 'mobile']));

                /*  //  inform to super admin for new user register //   */
                    //Mail::to('shahrukhdev52@gmail.com')->send(new TestMail($user));
                return response()->json([
                    'status'    => [
                        'Code'      => 200,
                        'Message'   => 'User created successfully',
                        'Results'   => $user
                    ]
                ]);
            } catch (\Exception $exception) {
                return response()->json([
                    'status'    => [
                        'Code'      => 403,
                        'Message'   => $exception->getMessage(),
                        'Results'   => []
                    ]
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return mixed
     */
    public function show($id) {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return mixed
     */
    public function update(Request $request, $id) {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return mixed
     */
    public function destroy($id) {

    }
}
