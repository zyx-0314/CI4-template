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

        // Demo behaviour: create session user. Replace with user creation in DB.
        $session->set('user', [
            'email' => $post['email'],
            'first_name' => $post['first_name'],
            'middle_name' => $post['middle_name'] ?? null,
            'last_name' => $post['last_name'],
            'display_name' => trim($post['first_name'] . ' ' . ($post['middle_name'] ?? '') . ' ' . $post['last_name'])
        ]);

        return redirect()->to('/admin');
    }
}
