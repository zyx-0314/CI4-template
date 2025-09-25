<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ServicesModel;
use App\Models\UsersModel;
use App\Models\RequestsModel;
use CodeIgniter\HTTP\ResponseInterface;

class Admin extends BaseController
{
    public function showDashboardPage()
    {
        try {
            // Persist request to database using RequestsModel
            $requestModel = new RequestsModel();
            // Persist service to database using ServicesModel
            $servicesModel = new ServicesModel();

            // Query Builder Counting the Data in Database
            $requestsCount = $requestModel->where('is_active', 1)->countAllResults();
            $servicesCount = $servicesModel->where('is_active', 1)->countAllResults();
        } catch (\Exception $e) {
            // Incase a issue with the system appear
            $requestsCount = "Server Issue: " . $e;
            $servicesCount = "Server Issue: " . $e;
        }

        return view(
            'admin/dashboard',
            [
                'requestsCount' => $requestsCount,
                'servicesCount' => $servicesCount,
            ]
        );
    }

    public function showServicesPage()
    {
        try {
            // Persist service to database using ServicesModel
            $serviceModel = new ServicesModel();

            // Query Builder servicea available and active the Data in Database
            $services = $serviceModel->where('is_active', 1)->orderBy('id', 'ASC')->findAll();

            // Number of all services
            $servicesCount = $serviceModel->where('is_active', 1)->countAllResults();

            // Filter Number of available Services
            $availableServicesCount = $serviceModel->where('is_active', 1)->where('is_available', 1)->countAllResults();
            $notAvailableServicesCount = $servicesCount - $availableServicesCount;
        } catch (\Exception $e) {
            // Incase a issue with the system appear
            $services = "Server Issue: " . $e;
        }

        return view('admin/services', [
            'services' => $services,
            'servicesCount' => $servicesCount,
            'availableServicesCount' => $availableServicesCount,
            'notAvailableServicesCount' => $notAvailableServicesCount,
        ]);
    }

    public function showInquiriesPage()
    {
        try {
            // Use RequestsModel to load active requests
            $requestModel = new RequestsModel();
            // Use ServicesModel to load active services
            $serviceModel = new ServicesModel();
            // Use UsersModel to load active accounts
            $userModel = new UsersModel();

            // Query Builder: active users ordered by id asc
            $accountList = $userModel->where('account_status', 1)->orderBy('id', 'ASC')->findAll();

            // Fetch all services once and index by ID
            $services = $serviceModel->findAll();
            $serviceMap = [];
            foreach ($services as $service) {
                $serviceMap[$service->id] = $service->title;
            }

            // Query Builder: active requests ordered by id asc
            // Join services to include service_name for display in views
            $requests = $requestModel
                ->select('requests.*, services.title as service_name')
                ->join('services', 'services.id = requests.service_id', 'left')
                ->where('requests.is_active', 1)
                ->orderBy('requests.id', 'ASC')
                ->findAll();

            // Replace service_id with service_name
            foreach ($requests as &$request) {
                $request['service_name'] = $serviceMap[$request['service_id']] ?? 'Unknown';
            }
            unset($request);

            // Number of all active requests
            $requestsCount = $requestModel->where('is_active', 1)->countAllResults();

            // Define 'upcoming' as requests with date_start >= today
            $today = date('Y-m-d');
            $upcomingRequestsCount = $requestModel->where('is_active', 1)->where('date_start >=', $today)->countAllResults();

            // Define 'pending' as requests with status = 'pending' (string) or status = 0
            // Try string first, fall back to numeric
            $pendingRequestsCount = $requestModel->where('is_active', 1)->groupStart()->where('status', 'pending')->orWhere('status', 0)->groupEnd()->countAllResults();
        } catch (\Exception $e) {
            $requests = "Server Issue: " . $e;
        }

        return view('admin/inquiries', [
            'requests' => $requests,
            'requestsCount' => $requestsCount ?? 0,
            'upcomingRequestsCount' => $upcomingRequestsCount ?? 0,
            'pendingRequestsCount' => $pendingRequestsCount ?? 0,
            'accountList' => $accountList
        ]);
    }

    public function showAccountsPage()
    {
        try {
            // Use UsersModel to load active accounts
            $userModel = new UsersModel();

            // Query Builder: active users ordered by id asc
            $accounts = $userModel->where('account_status', 1)->orderBy('id', 'ASC')->findAll();

            // Number of all active accounts
            $accountsCount = $userModel->where('account_status', 1)->countAllResults();

            // Filter Number of active accounts
            $verifiedEmailAccountsCount = $userModel->where('account_status', 1)->where('email_activated', 1)->countAllResults();
            $nonVerfiedEmailAccountsCount = $accountsCount - $verifiedEmailAccountsCount;
        } catch (\Exception $e) {
            $accounts = "Server Issue: " . $e;
        }

        return view('admin/accounts', [
            'accounts' => $accounts,
            'accountsCount' => $accountsCount ?? 0,
            'verifiedEmailAccountsCount' => $verifiedEmailAccountsCount ?? 0,
            'nonVerfiedEmailAccountsCount' => $nonVerfiedEmailAccountsCount ?? 0,
        ]);
    }

    public function createAccounts()
    {
        // Access service request
        $request = service('request');
        // Initialize Session
        $session = session();

        // Basic validation using CI's Validation service
        $validation = \Config\Services::validation();
        $validation->setRule('first_name', 'First name', 'required|min_length[2]|max_length[100]');
        $validation->setRule('middle_name', 'Middle name', 'permit_empty|max_length[100]');
        $validation->setRule('last_name', 'Last name', 'required|min_length[2]|max_length[100]');
        $validation->setRule('email', 'Email', 'required|valid_email');
        $validation->setRule('password', 'Password', 'required|min_length[8]');
        $validation->setRule('password_confirm', 'Password Confirmation', 'required|matches[password]');

        // Assign value from post to variable
        $post = $request->getPost();

        // If no value found from post, notify it is required
        if (! $validation->run($post)) {
            $errors = $validation->getErrors();

            // If AJAX/JSON request, keep JSON behavior
            $wantsJson = $request->isAJAX() || stripos((string)$request->getHeaderLine('Accept'), 'application/json') !== false;
            if ($wantsJson) {
                return $this->response
                    ->setStatusCode(ResponseInterface::HTTP_UNPROCESSABLE_ENTITY)
                    ->setJSON([
                        'success' => false,
                        'message' => 'Validation failed',
                        'errors'  => $errors,
                        'old'     => $post,
                    ]);
            }

            $session->setFlashdata('errors', array_values($errors));
            $session->setFlashdata('fieldErrors', $errors);
            $session->setFlashdata('old', $post);

            return redirect()->back()->withInput();
        }

        // Persist user to database using UsersModel
        $userModel = new UsersModel();

        // Prevent duplicate emails
        if ($userModel->where('email', $post['email'])->first()) {
            $wantsJson = $request->isAJAX() || stripos((string)$request->getHeaderLine('Accept'), 'application/json') !== false;
            if ($wantsJson) {
                return $this->response
                    ->setStatusCode(ResponseInterface::HTTP_CONFLICT)
                    ->setJSON(['success' => false, 'message' => 'Email already registered', 'errors' => ['email' => 'Email already registered']]);
            }

            $session->setFlashdata('errors', ['email' => 'Email already registered']);
            $session->setFlashdata('old', $post);
            return redirect()->back()->withInput();
        }

        // Handle profile image upload
        $profileImagePath = null;
        try {
            $file = $request->getFile('profile_image');
            if ($file && $file->isValid() && ! $file->hasMoved()) {
                $allowed = ['image/png', 'image/jpeg', 'image/jpg', 'image/webp'];
                $mime = $file->getClientMimeType();
                if (! in_array($mime, $allowed)) {
                    return $this->response->setStatusCode(ResponseInterface::HTTP_UNSUPPORTED_MEDIA_TYPE)
                        ->setJSON(['success' => false, 'message' => 'Invalid image type']);
                }

                $maxBytes = 5 * 1024 * 1024;
                if ($file->getSize() > $maxBytes) {
                    return $this->response->setStatusCode(413)
                        ->setJSON(['success' => false, 'message' => 'Image too large']);
                }

                $sub = date('Y') . DIRECTORY_SEPARATOR . date('m');
                $publicUploadDir = FCPATH . 'uploads' . DIRECTORY_SEPARATOR . 'profiles' . DIRECTORY_SEPARATOR . $sub . DIRECTORY_SEPARATOR;
                if (! is_dir($publicUploadDir)) mkdir($publicUploadDir, 0755, true);

                $newName = $file->getRandomName();
                $moved = $file->move($publicUploadDir, $newName);
                if ($moved) {
                    $profileImagePath = 'uploads/profiles/' . str_replace(DIRECTORY_SEPARATOR, '/', $sub) . '/' . $newName;
                }
            }
        } catch (\Exception $e) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                ->setJSON(['success' => false, 'message' => 'Failed to process profile image']);
        }

        try {
            // Prepare data
            $data = [
                'first_name' => $post['first_name'],
                'middle_name' => $post['middle_name'] ?? null,
                'last_name' => $post['last_name'],
                'email' => $post['email'],
                'password_hash' => password_hash($post['password'], PASSWORD_DEFAULT),
                'type' => $post['type'] ?? 'client',
                'account_status' => 1,
                'email_activated' => 0,
                'newsletter' => isset($post['newsletter']) ? 1 : 0,
                'gender' => $post['gender'] ?? null,
                'profile_image' => $profileImagePath,
            ];

            $inserted = $userModel->insert($data);

            if ($inserted === false) {
                return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                    ->setJSON(['success' => false, 'message' => 'Could not create account']);
            }

            return $this->response->setStatusCode(ResponseInterface::HTTP_CREATED)
                ->setJSON(['success' => true, 'message' => 'Account created']);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                ->setJSON(['success' => false, 'message' => 'Server error while creating account: ' . $e->getMessage()]);
        }
    }

    public function createService()
    {
        // Access service request
        $request = service('request');
        // Initialize Session
        $session = session();

        // Basic validation using CI's Validation service
        $validation = \Config\Services::validation();
        $rules = [
            'title' => [
                'label' => 'Title',
                'rules' => 'required|min_length[2]|max_length[255]',
            ],
            'cost' => [
                'label' => 'Cost',
                'rules' => 'required|numeric|greater_than[0]',
                'errors' => [
                    'numeric'       => 'Cost must be a number.',
                    'greater_than'  => 'Cost must be greater than 0.',
                ],
            ],
        ];

        // Assign value from post to variable
        $post = $request->getPost();

        // If no value found from post, notify it is required
        if (!$validation->setRules($rules)->run($post)) {
            $errors = $validation->getErrors();

            // If AJAX/JSON request, keep JSON behavior
            $wantsJson = $request->isAJAX() || stripos((string)$request->getHeaderLine('Accept'), 'application/json') !== false;
            if ($wantsJson) {
                return $this->response
                    ->setStatusCode(ResponseInterface::HTTP_UNPROCESSABLE_ENTITY)
                    ->setJSON([
                        'success' => false,
                        'message' => 'Validation failed',
                        'errors'  => $errors,
                        'old'     => $post,
                    ]);
            }

            $session->setFlashdata('errors', array_values($errors));
            $session->setFlashdata('fieldErrors', $errors);
            $session->setFlashdata('old', $post);

            return redirect()->back()->withInput();
        }

        // Image Upload
        // Placeholder
        $bannerImagePath = null;
        try {
            // Check if there is uploaded image
            $file = $request->getFile('banner_image');
            // Check if valid file, and cache it
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

                //  Format Directory
                $sub = date('Y') . DIRECTORY_SEPARATOR . date('m');
                $publicUploadDir = FCPATH . 'uploads' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . $sub . DIRECTORY_SEPARATOR;

                //  if the folder doesnt exist create it
                if (! is_dir($publicUploadDir)) mkdir($publicUploadDir, 0755, true);

                // Generate random name
                $newName = $file->getRandomName();
                // Move the file
                $moved = $file->move($publicUploadDir, $newName);
                // If successfully moved save the directory
                if ($moved) {
                    $bannerImagePath = 'uploads/services/' . str_replace(DIRECTORY_SEPARATOR, '/', $sub) . '/' . $newName;
                }
            }
        } catch (\Exception $e) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                ->setJSON(['success' => false, 'message' => 'Failed to process banner image']);
        }

        $inclusions = $post['inclusions'] ?? null;

        try {
            // Insert SQL procedure
            $model = new ServicesModel();

            $data = [
                'title' => $post['title'],
                'cost' => $post['cost'],
                'description' => $post['description'] ?? null,
                'inclusions' => $inclusions,
                'banner_image' => $bannerImagePath,
                'is_available' => isset($post['is_available']) ? 1 : 0,
                'is_active' => 1,
            ];

            $inserted = $model->insert($data);

            if ($inserted === false) {
                $session->setFlashdata('errors', ['general' => 'Could not create services']);
                $session->setFlashdata('old', $post);
                return redirect()->back()->withInput();
            }

            // Utilize JSON to transfer feedback into toast
            return $this->response->setStatusCode(ResponseInterface::HTTP_CREATED)
                ->setJSON(['success' => true, 'message' => 'Service created']);
        } catch (\Exception $e) {
            // Utilize JSON to transfer feedback into toast
            return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                ->setJSON(['success' => false, 'message' => 'Server error while creating service: ' . $e->getMessage()]);
        }
    }

    public function updateAccount()
    {
        // Access service request
        $request = service('request');
        // Initialize Session
        $session = session();

        $userModel = new UsersModel();

        // Basic validation using CI's Validation service
        $validation = \Config\Services::validation();
        $validation->setRule('id', 'ID', 'required|min_length[1]');
        $validation->setRule('type', 'User Type', 'required|min_length[1]');

        // Assign value from post to variable
        $post = $request->getPost();

        // If no value found from post, notify it is required
        if (! $validation->run($post)) {
            $session->setFlashdata('errors', $validation->getErrors());
            $session->setFlashdata('old', $post);
            return redirect()->back()->withInput();
        }

        try {
            $account = $userModel->where('id', $post['id'])->first();
            if (! $account) {
                /// Utilize JSON to transfer feedback into toast
                return $this->response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)
                    ->setJSON(['success' => false, 'message' => 'Account not found']);
            }

            // Prepare Data
            $payload = [
                'id' => $post['id'],
                'type' => $post['type'],
            ];

            // Update data
            $ok = $userModel->save($payload);
            if ($ok === false) {
                throw new \Exception('Model update failed');
            }

            // Utilize JSON to transfer feedback into toast
            return $this->response->setStatusCode(ResponseInterface::HTTP_OK)
                ->setJSON(['success' => true, 'message' => 'Account Type Updated', 'data' => ['id' => $post['id']]]);
        } catch (\Throwable $e) {
            // Utilize JSON to transfer feedback into toast
            return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                ->setJSON(['success' => false, 'message' => 'Server error while updating account: ' . $e->getMessage()]);
        }
    }


    public function updateService()
    {
        // Access service request
        $request = service('request');
        // Initialize Session
        $session = session();

        $serviceModel = new ServicesModel();

        // Basic validation using CI's Validation service
        $validation = \Config\Services::validation();
        $validation->setRule('id', 'ID', 'required|min_length[1]');
        $validation->setRule('title', 'Title', 'required|min_length[3]');
        $validation->setRule('cost', 'Cost', 'required|greater_than[0]');

        // Assign value from post to variable
        $post = $request->getPost();

        // If no value found from post, notify it is required
        if (! $validation->run($post)) {
            $session->setFlashdata('errors', $validation->getErrors());
            $session->setFlashdata('old', $post);
            return redirect()->back()->withInput();
        }

        $data = $serviceModel->where('id', $post['id'])->first();

        // Image Upload
        // Placeholder
        $bannerImagePath = null;
        try {
            // Check if there is uploaded image
            $file = $this->request->getFile('banner_image');
            // Check if valid file, and cache it
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
                $uploadPath = FCPATH . 'uploads/services/' . $post['id'];
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
                $bannerImagePath = '/uploads/services/' . $post['id'] . "/" . $newName;
            }
        } catch (\Exception $e) {
            // Utilize JSON to transfer feedback into toast
            log_message('error', $e->getMessage());
            return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                ->setJSON(['success' => false, 'message' => 'Failed to process banner image']);
        }

        try {
            $service = $serviceModel->find($post['id']);
            if (! $service) {
                // Utilize JSON to transfer feedback into toast
                return $this->response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)
                    ->setJSON(['success' => false, 'message' => 'Service not found']);
            }

            // Prepare data
            $payload = [
                'id' => $post['id'],
                'title' => $post['title'],
                'cost' => $post['cost'],
                'description' => $post['description'],
                'inclusions' => $post['inclusions'],
                'is_available' => $post['is_available'] ?? 0,
            ];

            // Additional Data Payload
            if ($bannerImagePath) {
                $bannerImagePath = str_replace("uploads/services/", "", $bannerImagePath);
                $bannerImagePath = str_replace("upload/services/", "", $bannerImagePath);

                if (strpos($bannerImagePath, 'upload/services/') !== 0) {
                    $bannerImagePath = ltrim($bannerImagePath, '/');
                    $bannerImagePath = "uploads/services/" . $bannerImagePath;
                }

                $payload['banner_image'] = $bannerImagePath;
            }

            // Update data
            $ok = $serviceModel->save($payload);
            if ($ok === false) {
                throw new \RuntimeException('Model update failed');
            }

            // Utilize JSON to transfer feedback into toast
            return $this->response->setStatusCode(ResponseInterface::HTTP_OK)
                ->setJSON(['success' => true, 'message' => 'Service updated', 'data' => ['id' => $post['id']]]);
        } catch (\Exception $e) {
            // Utilize JSON to transfer feedback into toast
            return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                ->setJSON(['success' => false, 'message' => 'Server error while updating service: ' . $e->getMessage()]);
        }
    }

    public function deleteAccount()
    {
        // Access service request
        $request = service('request');
        // Initialize Session
        $session = session();

        $userModel = new UsersModel();

        // Basic validation using CI's Validation service
        $validation = \Config\Services::validation();
        $validation->setRule('id', 'ID', 'required|min_length[1]');

        // Assign value from post to variable
        $post = $request->getPost();

        try {
            $user = $userModel->find($post['id']);
            if (! $user) {
                return $this->response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)
                    ->setJSON(['success' => false, 'message' => 'Account not found']);
            }

            // Prepare data - soft delete
            $user->account_status = 0;
            $user->deleted_at = date('Y-m-d H:i:s');

            // Update data
            $ok = $userModel->save($user);
            if ($ok === false) {
                return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                    ->setJSON(['success' => false, 'message' => 'Failed to delete account']);
            }

            // Utilize JSON to transfer feedback into toast
            return $this->response->setStatusCode(ResponseInterface::HTTP_OK)
                ->setJSON(['success' => true, 'message' => 'Account deleted', 'data' => ['id' => $post['id']]]);
        } catch (\Exception $e) {
            // Utilize JSON to transfer feedback into toast
            return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                ->setJSON(['success' => false, 'message' => 'Server error while deleting account']);
        }
    }

    public function deleteService()
    {
        // Access service request
        $request = service('request');
        // Initialize Session
        $session = session();

        $serviceModel = new ServicesModel();

        // Basic validation using CI's Validation service
        $validation = \Config\Services::validation();
        $validation->setRule('id', 'ID', 'required|min_length[1]');

        // Assign value from post to variable
        $post = $request->getPost();

        try {
            $service = $serviceModel->find($post['id']);
            if (! $service) {
                return $this->response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)
                    ->setJSON(['success' => false, 'message' => 'Service not found']);
            }

            // Prepare data
            $service->is_active = 0;
            $service->deleted_at = date('Y-m-d H:i:s');

            // Update data
            $ok = $serviceModel->save($service);
            if ($ok === false) {
                return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                    ->setJSON(['success' => false, 'message' => 'Failed to delete service']);
            }

            // Utilize JSON to transfer feedback into toast
            return $this->response->setStatusCode(ResponseInterface::HTTP_OK)
                ->setJSON(['success' => true, 'message' => 'Service deleted', 'data' => ['id' => $post['id']]]);
        } catch (\Exception $e) {
            // Utilize JSON to transfer feedback into toast
            return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                ->setJSON(['success' => false, 'message' => 'Server error while deleting service']);
        }
    }

    public function updateRequest()
    {
        $request = service('request');
        $session = session();

        $requestModel = new RequestsModel();

        $validation = \Config\Services::validation();
        $validation->setRule('id', 'ID', 'required|min_length[1]');

        $post = $request->getPost();

        if (! $validation->run($post)) {
            $session->setFlashdata('errors', $validation->getErrors());
            $session->setFlashdata('old', $post);
            return redirect()->back()->withInput();
        }

        try {
            $existing = $requestModel->find($post['id']);
            if (! $existing) {
                return $this->response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)
                    ->setJSON(['success' => false, 'message' => 'Request not found']);
            }

            // Only allow specific fields to be updated
            $payload = ['id' => $post['id']];
            $allowed = ['status', 'service_id', 'first_name', 'last_name', 'date_start', 'date_end', 'phone', 'email', 'additional_requests', 'user_id'];
            foreach ($allowed as $k) {
                if (array_key_exists($k, $post)) {
                    $payload[$k] = $post[$k] === '' ? null : $post[$k];
                }
            }

            $ok = $requestModel->save($payload);
            if ($ok === false) {
                throw new \RuntimeException('Model update failed');
            }

            return $this->response->setStatusCode(ResponseInterface::HTTP_OK)
                ->setJSON(['success' => true, 'message' => 'Inquiry updated', 'data' => ['id' => $post['id']]]);
        } catch (\Throwable $e) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                ->setJSON(['success' => false, 'message' => 'Server error while updating inquiry: ' . $e->getMessage()]);
        }
    }
}
