<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use CodeIgniter\HTTP\ResponseInterface;

class Setting extends BaseController
{
    public function showProfilePage()
    {
        // Initialize Session
        $session = session();

        // Persist user to database using UsersModel
        $userModel = new UsersModel();

        if (! $session->has('user')) {
            // Not authenticated — send to login
            return redirect()->to('/login');
        }

        // Try to prefill user info via session
        $userSession = $session->get('user');
        $userId = $userSession['id'] ?? null;

        // Query Builder Select List the Data in Database
        $user = $userModel->where('id', $userId)->first();

        if (! $user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('User not found');
        }

        return view('settings/profile', ['user' => $user]);
    }

    public function showProfileSettingPage()
    {
        // Initialize Session
        $session = session();

        // Persist user to database using UsersModel
        $userModel = new UsersModel();

        if (! $session->has('user')) {
            // Not authenticated — send to login
            return redirect()->to('/login');
        }

        // Try to prefill user info via session
        $userSession = $session->get('user');

        // Query Builder Select List the Data in Database
        $user = $userModel->where('id', $userSession['id'])->first();

        if (! $user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('User not found');
        }

        return view('settings/profile_setting', ['user' => $user]);
    }

    public function updateProfile()
    {
        // Initialize Session
        $session = session();

        // Persist user to database using UsersModel
        $userModel = new UsersModel();

        if (! $session->has('user')) {
            // Not authenticated — send to login
            return redirect()->to('/login');
        }

        // Try to prefill user info via session
        $userSession = $session->get('user');
        $userId = $userSession['id'] ?? null;
        $request = service('request');

        // Assign value from post to variable
        $post = $request->getPost();

        // Basic validation using CI's Validation service
        $validation = \Config\Services::validation();
        $rules = [
            'first_name' => [
                'label' => 'First name',
                'rules' => 'required|min_length[2]|max_length[100]',
            ],
            'last_name' => [
                'label' => 'Last name',
                'rules' => 'required|min_length[2]|max_length[100]',
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email',
            ]
        ];

        if (! $validation->setRules($rules)->run($post)) {
            $errors = $validation->getErrors();

            // For AJAX clients return JSON like before
            if ($request->isAJAX()) {
                return $this->response->setJSON([
                    'ok'     => false,
                    'errors' => $errors,
                    'old'    => $post,
                ])->setStatusCode(422);
            }

            $session->setFlashdata('errors', $errors);
            $session->setFlashdata('old', $post);
            return redirect()->back()->withInput();
        }

        // Prevent changing email to an existing account
        $existing = $userModel->where('email', $post['email'])->where('id !=', $userId)->first();
        if ($existing) {
            $session->setFlashdata('errors', ['email' => 'Email already used by another account']);
            $session->setFlashdata('old', $post);
            return redirect()->back()->withInput();
        }

        // Check old Data if it has image
        $data = $userModel->where('id', $userId)->first();

        // Prepare data
        $updateData = [
            'first_name' => $post['first_name'],
            'middle_name' => $post['middle_name'] ?? null,
            'last_name' => $post['last_name'],
            'email' => $post['email'],
            'gender' => $post['gender'] ?? null,
            'newsletter' => isset($post['newsletter']) ? 1 : 0,
        ];

        // File upload (profile image)
        $file = $request->getFile('profile_image');
        if ($file && $file->isValid() && ! $file->hasMoved()) {
            $allowed = ['image/png', 'image/jpeg', 'image/jpg', 'image/webp'];
            $mime = $file->getClientMimeType();

            // Check if valid image format
            if (! in_array($mime, $allowed)) {
                return $this->response->setStatusCode(ResponseInterface::HTTP_UNSUPPORTED_MEDIA_TYPE)
                    ->setJSON(['success' => false, 'message' => 'Invalid image type']);
            }

            $maxBytes = 5 * 1024 * 1024;

            // Check if valid size
            if ($file->getSize() > $maxBytes) {
                return $this->response->setStatusCode(413)
                    ->setJSON(['success' => false, 'message' => 'Image too large']);
            }

            // Ensure public/uploads exists and move file there so it's web-accessible
            $uploadPath = FCPATH . 'uploads/profiles/' . $userId;
            if (! is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            // Delete old image if it exists
            if (!empty($data->profile_image)) {
                $oldImagePath = FCPATH . ltrim($data->profile_image, '/');
                if (is_file($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $newName = $file->getRandomName();
            $file->move($uploadPath, $newName);
            $updateData['profile_image'] = '/uploads/profiles/' . $userId . '/' . $newName;
        }

        // Save new image
        $saved = $userModel->update($userId, $updateData);
        if ($saved === false) {
            $session->setFlashdata('errors', ['general' => 'Could not update profile']);
            $session->setFlashdata('old', $post);
            return redirect()->back()->withInput();
        }

        // Update minimal session payload
        $session->set('user', array_merge($session->get('user'), [
            'first_name' => $updateData['first_name'],
            'last_name' => $updateData['last_name'],
            'email' => $updateData['email'],
            'display_name' => trim((($updateData['first_name'][0] ?? '') . ' ' . ($updateData['middle_name'][0] ?? '') . ' ' . ($updateData['last_name'] ?? ''))),
        ]));

        $session->setFlashdata('success', 'Profile updated successfully');
        return redirect()->to('/settings/profile');
    }

    public function sendEmailVerification()
    {
        // Initialize Session
        $session = session();

        // Verify if it has user logged in
        if (!$session->has('user')) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Not authenticated'
            ])->setStatusCode(401);
        }

        // Get data from session
        $userSession = $session->get('user');
        $userId = $userSession['id'] ?? null;
        $userEmail = $userSession['email'] ?? null;

        // Verify if user have data
        if (!$userId || !$userEmail) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'User information not found'
            ])->setStatusCode(400);
        }

        // Generate verification code (2 letters + 4 digits)
        $letters = '';
        for ($i = 0; $i < 2; $i++) {
            $letters .= chr(rand(65, 90)); // A-Z
        }
        $numbers = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        $verificationCode = $letters . $numbers;

        // Store verification code in session with timestamp
        $session->set('email_verification', [
            'code' => $verificationCode,
            'timestamp' => time(),
            'attempts' => 0
        ]);

        try {
            // Send email
            $email = \Config\Services::email();

            $email->setFrom('noreply@yoursite.com', 'Sunset Funeral Homes');
            $email->setTo($userEmail);
            $email->setSubject('Email Verification Code');

            $message = "
                <h2>Email Verification</h2>
                <p>Your verification code is: <strong style='font-size: 24px; letter-spacing: 3px;'>{$verificationCode}</strong></p>
                <p>This code will expire in 5 minutes.</p>
                <p>If you did not request this verification, please ignore this email.</p>
            ";

            $email->setMessage($message);

            if ($email->send()) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Verification code sent successfully'
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Failed to send verification code'
                ])->setStatusCode(500);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to send verification code'
            ])->setStatusCode(500);
        }
    }

    /**
     * Verify email verification code
     */
    public function verifyEmail()
    {
        $session = session();
        $request = service('request');

        if (!$session->has('user')) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Not authenticated'
            ])->setStatusCode(401);
        }

        $verificationData = $session->get('email_verification');

        if (!$verificationData) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'No verification code found. Please request a new one.'
            ])->setStatusCode(400);
        }

        // Check if code has expired (5 minutes = 300 seconds)
        if (time() - $verificationData['timestamp'] > 300) {
            $session->remove('email_verification');
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Verification code has expired. Please request a new one.'
            ])->setStatusCode(400);
        }

        $submittedCode = $request->getPost('verification_code');

        if (!$submittedCode || strlen($submittedCode) !== 6) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Please enter a valid 6-character verification code'
            ])->setStatusCode(400);
        }

        // Increment attempts
        $verificationData['attempts']++;
        $session->set('email_verification', $verificationData);

        // Check if too many attempts (max 3 attempts)
        if ($verificationData['attempts'] > 3) {
            $session->remove('email_verification');
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Too many failed attempts. Please request a new verification code.'
            ])->setStatusCode(400);
        }

        // Verify the code (case-insensitive for letters)
        $storedCode = $verificationData['code'];
        if (strtoupper($submittedCode) === strtoupper($storedCode)) {
            // Success - remove verification data and mark email as verified
            $session->remove('email_verification');

            // Update user's email verification status in database
            $userModel = new UsersModel();
            $userSession = $session->get('user');
            $userId = $userSession['id'];

            $userModel->update($userId, ['email_activated' => 1]);

            // Update session
            $userSession['email_activated'] = 1;
            $session->set('user', $userSession);

            log_message('info', "Email verified successfully for user ID: {$userId}");

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Email verified successfully!'
            ]);
        } else {
            $remainingAttempts = 3 - $verificationData['attempts'];

            return $this->response->setJSON([
                'success' => false,
                'message' => "Invalid verification code. {$remainingAttempts} attempts remaining."
            ])->setStatusCode(400);
        }
    }
}
