<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;


class UserController extends BaseController
{
    public function login()
    {
        $data = [
            'title' => 'ADM Mis.Raudlatul Atfal',
        ];

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'username' => 'required|min_length[6]|max_length[50]|validateUser[username]',
                'password' => 'required|min_length[5]|max_length[255]|validateUser[username,password]',
            ];

            $errors = [
                'password' => [
                    'validateUser' => "Email or Password didn't match",
                ],
            ];

            if (!$this->validate($rules, $errors)) {
                return view('login', [
                    "validation" => $this->validator,
                    'title' => 'ADM Mis.Raudlatul Atfal',

                ]);
            } else {
                $model = new UserModel();

                $user = $model->where('username', $this->request->getVar('username'))
                    ->first();

                // Stroing session values
                $this->setUserSession($user);

                // Redirecting to dashboard after login
                if ($user['role'] == "superadmin") {

                    return redirect()->to(base_url('sadmin'));
                } elseif ($user['role'] == "admin") {

                    return redirect()->to(base_url('admin'));
                } elseif ($user['role'] == "siswa") {

                    return redirect()->to(base_url('siswa'));
                }
            }
        }
        return view('login', $data);
    }

    private function setUserSession($user)
    {
        $data = [
            'id_users' => $user['id_users'],
            'id_siswa' => $user['id_siswa'],
            'name' => $user['name'],
            'username' => $user['username'],
            'isLoggedIn' => true,
            "role" => $user['role'],
        ];

        session()->set($data);
        return true;
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }
}
