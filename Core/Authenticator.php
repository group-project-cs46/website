<?php

namespace Core;

use Models\User;

class Authenticator
{
    public function attempt($email, $password)
    {
        $user = User::find($email);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $this->login([
                    'email' => $email,
                    'role' => $user['role']
                ]);

                return true;
            }
        }
        return false;
    }

    protected function login($user)
    {
        $_SESSION['user'] = [
            'email' => $user['email'],
            'role' => $user['role'],
        ];
        session_regenerate_id(true);
    }

    public static function logout()
    {
        Session::destroy();
    }

}