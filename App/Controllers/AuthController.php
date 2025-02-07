<?php

namespace App\Controllers;

use App\Models\User;

class AuthController extends Controller
{
    public function register(): void {
        if ($this->getMethod() === 'GET') {
            $this->render('Register');
        } else if ($this->getMethod() === 'POST') {
            $data = $this->getData();

            if (empty($data['name']) || empty($data['email']) || empty($data['password'])) {
                $this->setMessage('Please fill all fields');
                $this->redirect('/register');
                exit;
            }

            $name = $data['name'];
            $email = $data['email'];
            $password = $data['password'];

            $user = new User($name, $email, $password);

            if ($user->save()){
                $this->setMessage('Registered!');
                $this->redirect('/register');
            }

            $this->setMessage('Something went wrong');
            $this->redirect('/register');
        }
    }

    public function login(): void {
        if ($this->getMethod() === 'GET') {
            $this->render('Login');
        }else if ($this->getMethod() === 'POST') {
            $data = $this->getData();

            if (empty($data['email']) || empty($data['password'])) {
                $this->setMessage('Please fill all fields');
                $this->redirect('/login');
                exit;
            }

            $email = $data['email'];
            $password = $data['password'];

            $user = new User();
            $user->setEmail($email);
            $user = $user->getByEmail();

            if ($user) {
                if ($user->verifyPassword($password)) {
                    session_start();
                    $_SESSION['user_id'] = $user->getId();
                    $_SESSION['user_name'] = $user->getName();
                    $this->setMessage('Login successful!');
                    $this->redirect('/');
                } else {
                    $this->setMessage('Incorrect password');
                    $this->redirect('/login');
                }
            } else {
                $this->setMessage('Email not found');
                $this->redirect('/login');
            }

        }
    }
}