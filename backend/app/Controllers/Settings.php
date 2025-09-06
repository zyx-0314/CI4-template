<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Settings extends BaseController
{
    // Show the frontend-only profile form. Uses session data only (no DB writes).
    public function profile()
    {
        $session = session();

        if (! $session->has('user')) {
            return redirect()->to('/login');
        }

        $errors = $session->getFlashdata('errors') ?? [];
        $old = $session->getFlashdata('old') ?? [];
        $success = $session->getFlashdata('success') ?? null;

        $user = $session->get('user') ?? [];

        $data = [
            'user' => array_merge(is_array($user) ? $user : (array) $user, $old),
            'errors' => $errors,
            'success' => $success,
        ];

        return view('settings/profile', $data);
    }

    // Update session-only profile (frontend demo).
    public function update()
    {
        $session = session();

        if (! $session->has('user')) {
            return redirect()->to('/login');
        }

        $request = service('request');
        $post = $request->getPost();

        $validation = \Config\Services::validation();
        $validation->setRule('first_name', 'First name', 'required|max_length[100]');
        $validation->setRule('middle_name', 'Middle name', 'permit_empty|max_length[100]');
        $validation->setRule('last_name', 'Last name', 'required|max_length[100]');
        $validation->setRule('email', 'Email', 'required|valid_email');

        if (! $validation->run($post)) {
            $session->setFlashdata('errors', $validation->getErrors());
            $session->setFlashdata('old', $post);
            return redirect()->back()->withInput();
        }

        $user = $session->get('user');
        $userArr = is_array($user) ? $user : (method_exists($user, 'toArray') ? $user->toArray() : (array) $user);

        $userArr['first_name'] = $post['first_name'];
        $userArr['middle_name'] = $post['middle_name'] ?? null;
        $userArr['last_name'] = $post['last_name'];
        $userArr['email'] = $post['email'];

        // Don't persist to DB — frontend demo only.
        $session->set('user', $userArr);
        $session->setFlashdata('success', 'Profile updated (frontend demo).');

        return redirect()->to('/settings/profile');
    }
}
