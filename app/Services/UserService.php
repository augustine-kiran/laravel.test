<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    /**
     * Function for creating a new user
     * 
     * @param $request
     * 
     * @return array $status = ['status' => true/false, 'message' => "message"]
     */
    public function createUser($request)
    {
        try {
            $request['password'] = bcrypt($request->password);
            User::create($request->all('name', 'username', 'password'));
            return [
                'status' => true,
                'message' => 'User created successfull',
            ];
        } catch (\Exception $ex) {
            return [
                'status' => false,
                'message' => 'User create not successful',
            ];
        }
    }
}
