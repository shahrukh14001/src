<?php

namespace App\Orange\Helpers;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserHelper extends Model
{
    public function create($attributes) {
        \DB::beginTransaction();
        try {
            if(!$this->validMobile($attributes)) {
                if(!$this->validEmail($attributes)) {
                    if($user = $this->newUser($attributes)) {
                        \DB::commit();
                        return $user;
                    }
                    throw new \Exception("Failed to create user, please try again");
                }
                throw new \Exception("Oops, Email already in use, please try again");
            }
            throw new \Exception("Oops, Mobile number already in use. please try again");
        } catch(\Exception $e) {
            \DB::rollback();
            throw new \Exception($e->getMessage());
        }
    }
    private function validMobile($attributes) {
        return User::query()->where('mobile', $attributes['mobile'])->count();
    }

    private function validEmail($attributes) {
        return User::query()->where('email', $attributes['email'])->count();
    }

    private function newUser($attributes) {
        return User::query()->create([
            'name'              => $attributes['name'],
            'email'             => $attributes['email'],
            'mobile'            => $attributes['mobile'],
            'password'          => \Hash::make('secret'),
            'role_id'           => 15,
            'permission_type'   => 'viewer',
            'status'            => 0
        ]);
    }
}
