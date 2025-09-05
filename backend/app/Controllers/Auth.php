<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Auth extends BaseController
{
    public function showLogin()
    {
        $session = session();

        // If already logged in, send to admin
        if ($session->has('user')) {
            return redirect()->to('/admin');
        }

        // Pull flashdata errors/old if present
        $errors = $session->getFlashdata('errors') ?? [];
        $old = $session->getFlashdata('old') ?? [];

        return view('auth/login', ['errors' => $errors, 'old' => $old]);
    }

    public function login()
    {
        $request = service('request');
        $session = session();

        // Basic validation using CI's Validation service
        $validation = \Config\Services::validation();
        $validation->setRule('email', 'Email', 'required|valid_email');
        $validation->setRule('password', 'Password', 'required');

        $post = $request->getPost();

        if (! $validation->run($post)) {
            // Save errors and old input in flashdata and redirect back (PRG)
            $session->setFlashdata('errors', $validation->getErrors());
            $session->setFlashdata('old', $post);
            return redirect()->back()->withInput();
        }

        $email = $request->getPost('email');

        // NOTE: Demo behaviour — accept any credentials. Replace with real auth.
        $session->set('user', ['email' => $email]);

        return redirect()->to('/admin');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }

    public function showSignup()
    {
        $session = session();

        if ($session->has('user')) {
            return redirect()->to('/admin');
        }

        $errors = $session->getFlashdata('errors') ?? [];
        $old = $session->getFlashdata('old') ?? [];

        return view('auth/signup', ['errors' => $errors, 'old' => $old]);
    }

    public function signup()
    {
        $request = service('request');
        $session = session();

        $validation = \Config\Services::validation();
        $validation->setRule('first_name', 'First name', 'required|min_length[1]|max_length[100]');
        $validation->setRule('middle_name', 'Middle name', 'permit_empty|max_length[100]');
        $validation->setRule('last_name', 'Last name', 'required|min_length[1]|max_length[100]');
        $validation->setRule('email', 'Email', 'required|valid_email');
        $validation->setRule('password', 'Password', 'required|min_length[6]');
        $validation->setRule('password_confirm', 'Password Confirmation', 'required|matches[password]');

        $post = $request->getPost();

        if (! $validation->run($post)) {
            $session->setFlashdata('errors', $validation->getErrors());
            $session->setFlashdata('old', $post);
            return redirect()->back()->withInput();
        }

        // Persist user to database using UserModel
        $userModel = new \App\Models\UserModel();

        // Prevent duplicate emails
        if ($userModel->where('email', $post['email'])->first()) {
            $session->setFlashdata('errors', ['email' => 'Email already registered']);
            $session->setFlashdata('old', $post);
            return redirect()->back()->withInput();
        }

        $data = [
            'first_name' => $post['first_name'],
            'middle_name' => $post['middle_name'] ?? null,
            'last_name' => $post['last_name'],
            'email' => $post['email'],
            'password_hash' => password_hash($post['password'], PASSWORD_DEFAULT),
            'type' => 'client',
            'account_status' => 1,
            'email_activated' => 0,
            'newsletter' => 1,
        ];

        $inserted = $userModel->insert($data);

        if ($inserted === false) {
            $session->setFlashdata('errors', ['general' => 'Could not create account']);
            $session->setFlashdata('old', $post);
            return redirect()->back()->withInput();
        }

        // Get inserted user (model may have set id via beforeInsert callback)
        $user = $userModel->find($inserted);

        $session->set('user', [
            'id' => $user['id'] ?? $inserted,
            'email' => $user['email'],
            'first_name' => $user['first_name'],
            'last_name' => $user['last_name'],
            'display_name' => trim($user['first_name'] . ' ' . ($user['middle_name'] ?? '') . ' ' . $user['last_name'])
        ]);

        return redirect()->to('/admin');
    }
}
