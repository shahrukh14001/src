<?php

namespace App\Http\Controllers\Web;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  $user
     * @return mixed
     */
    public function show(User $user) {
        return view('users.show', ['user' =>$user ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $user
     * @return mixed
     */
    public function update(Request $request, User $user) {
        try {
            if($user) {
                $user->update(['status' => $request->all()['status']]);
                return response()->json([
                    'status'    => [
                        'response'  => 'success',
                        'message'   => 'User updated successfully',
                        'code'      => 200,
                        'error'     => ''
                    ]
                ]);
            }
            throw new \Exception('Invalid request, user not found');
        } catch (\Exception $exception) {
            return response()->json([
                'status' => [
                    'response'  => 'error',
                    'message'   => 'Oops, Failed to update status, please try again',
                    'Code'      => 403,
                    'error'     => $exception->getMessage()
                ]
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
