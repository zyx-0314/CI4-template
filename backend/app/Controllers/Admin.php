<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Admin extends BaseController
{
    public function dashboard()
    {
        return view('admin/dashboard');
    }

    public function services()
    {
        try {
            $db = \Config\Database::connect();
            $builder = $db->table('services');
            $services = $builder
                ->where('is_active', 1)
                ->orderBy('id', 'ASC')
                ->get()
                ->getResultArray();
            return view('admin/services', ['services' => $services]);
        } catch (\Exception $e) {
            // If DB not available, let the view fall back to its demo dataset
            return view('admin/services');
        }
    }

    /**
     * Create a new service (AJAX/JSON endpoint)
     * Expects POST: title, cost, description, inclusions (CSV), is_available
     * Returns JSON { success: bool, message: string, data?: {id: int} }
     */
    public function createService()
    {
        // Only allow POST
        $incomingMethod = strtolower($this->request->getMethod());
        if ($incomingMethod !== 'post') {
            return $this->response->setStatusCode(ResponseInterface::HTTP_METHOD_NOT_ALLOWED)
                ->setJSON(['success' => false, 'message' => 'Method not allowed']);
        }

        // Simple validation
        $rules = [
            'title' => 'required|min_length[2]|max_length[255]',
            'cost'  => 'required|numeric',
        ];

        if (! $this->validate($rules)) {
            $errors = $this->validator->getErrors();
            return $this->response->setStatusCode(ResponseInterface::HTTP_UNPROCESSABLE_ENTITY)
                ->setJSON(['success' => false, 'message' => 'Validation failed', 'errors' => $errors]);
        }

        $title = $this->request->getPost('title');
        $cost = $this->request->getPost('cost');
        $description = $this->request->getPost('description');
        $inclusions = $this->request->getPost('inclusions');
        $isAvailable = $this->request->getPost('is_available') ? 1 : 0;

        // Handle banner image upload if present
        $bannerImagePath = null;
        try {
            $file = $this->request->getFile('banner_image');
            if ($file && $file->isValid() && ! $file->hasMoved()) {
                // simple validation: allow png, jpg, jpeg, webp and limit size (5MB)
                $allowed = ['image/png', 'image/jpeg', 'image/jpg', 'image/webp'];
                $mime = $file->getClientMimeType();
                if (! in_array($mime, $allowed)) {
                    return $this->response->setStatusCode(ResponseInterface::HTTP_UNSUPPORTED_MEDIA_TYPE)
                        ->setJSON(['success' => false, 'message' => 'Invalid image type']);
                }

                $maxBytes = 5 * 1024 * 1024;
                if ($file->getSize() > $maxBytes) {
                    // 413 Payload Too Large
                    return $this->response->setStatusCode(413)
                        ->setJSON(['success' => false, 'message' => 'Image too large']);
                }

                // Create upload directory if missing under public so files are directly accessible
                $sub = date('Y') . DIRECTORY_SEPARATOR . date('m');
                $publicUploadDir = FCPATH . 'uploads' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . $sub . DIRECTORY_SEPARATOR;
                if (! is_dir($publicUploadDir)) {
                    mkdir($publicUploadDir, 0755, true);
                }

                // Use random name to avoid collisions and move file into public uploads
                $newName = $file->getRandomName();
                $moved = $file->move($publicUploadDir, $newName);
                if ($moved) {
                    // store path relative to public (so it can be used as /uploads/... in views)
                    $bannerImagePath = 'uploads/services/' . str_replace(DIRECTORY_SEPARATOR, '/', $sub) . '/' . $newName;
                }
            }
        } catch (\Exception $e) {
            // If upload fails, log and continue (or return error). We'll return error to client.
            log_message('error', 'Banner upload failed: ' . $e->getMessage());
            return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                ->setJSON(['success' => false, 'message' => 'Failed to process banner image']);
        }

        // Normalize inclusions: store as CSV string (backend currently expects CSV in view)
        if (is_array($inclusions)) {
            $inclusions = implode(',', $inclusions);
        }

        try {
            $db = \Config\Database::connect();
            $builder = $db->table('services');

            $data = [
                'title' => $title,
                'cost' => $cost,
                'description' => $description,
                'inclusions' => $inclusions,
                // banner_image upload disabled for now — leave null/empty
                'banner_image' => $bannerImagePath,
                'is_available' => $isAvailable,
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $builder->insert($data);
            $insertId = $db->insertID();

            return $this->response->setStatusCode(ResponseInterface::HTTP_CREATED)
                ->setJSON(['success' => true, 'message' => 'Service created', 'data' => ['id' => $insertId]]);
        } catch (\Exception $e) {
            log_message('error', 'Failed to create service: ' . $e->getMessage());
            return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                ->setJSON(['success' => false, 'message' => 'Server error while creating service']);
        }
    }

    /**
     * Update an existing service (AJAX/JSON endpoint)
     * Expects POST: id, title, cost, description, inclusions (CSV), is_available
     * Optional file: banner_image
     */
    public function updateService()
    {
        // Only allow POST
        $incomingMethod = strtolower($this->request->getMethod());
        if ($incomingMethod !== 'post') {
            return $this->response->setStatusCode(ResponseInterface::HTTP_METHOD_NOT_ALLOWED)
                ->setJSON(['success' => false, 'message' => 'Method not allowed']);
        }

        $id = $this->request->getPost('id');
        if (empty($id)) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_UNPROCESSABLE_ENTITY)
                ->setJSON(['success' => false, 'message' => 'Missing service id']);
        }

        // Validation rules (same as create)
        $rules = [
            'title' => 'required|min_length[2]|max_length[255]',
            'cost'  => 'required|numeric',
        ];

        if (! $this->validate($rules)) {
            $errors = $this->validator->getErrors();
            return $this->response->setStatusCode(ResponseInterface::HTTP_UNPROCESSABLE_ENTITY)
                ->setJSON(['success' => false, 'message' => 'Validation failed', 'errors' => $errors]);
        }

        $title = $this->request->getPost('title');
        $cost = $this->request->getPost('cost');
        $description = $this->request->getPost('description');
        $inclusions = $this->request->getPost('inclusions');
        $isAvailable = $this->request->getPost('is_available') ? 1 : 0;

        // Handle banner image upload if present
        $bannerImagePath = null;
        try {
            $file = $this->request->getFile('banner_image');
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
                $publicUploadDir = FCPATH . 'uploads' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . $sub . DIRECTORY_SEPARATOR;
                if (! is_dir($publicUploadDir)) mkdir($publicUploadDir, 0755, true);

                $newName = $file->getRandomName();
                $moved = $file->move($publicUploadDir, $newName);
                if ($moved) {
                    $bannerImagePath = 'uploads/services/' . str_replace(DIRECTORY_SEPARATOR, '/', $sub) . '/' . $newName;
                }
            }
        } catch (\Exception $e) {
            log_message('error', 'Banner upload failed (update): ' . $e->getMessage());
            return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                ->setJSON(['success' => false, 'message' => 'Failed to process banner image']);
        }

        if (is_array($inclusions)) {
            $inclusions = implode(',', $inclusions);
        }

        try {
            $db = \Config\Database::connect();
            $builder = $db->table('services');

            // Build update payload
            $data = [
                'title' => $title,
                'cost' => $cost,
                'description' => $description,
                'inclusions' => $inclusions,
                'is_available' => $isAvailable,
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            if ($bannerImagePath) {
                $data['banner_image'] = $bannerImagePath;
            }

            $builder->where('id', $id)->update($data);

            return $this->response->setStatusCode(ResponseInterface::HTTP_OK)
                ->setJSON(['success' => true, 'message' => 'Service updated', 'data' => ['id' => $id]]);
        } catch (\Exception $e) {
            log_message('error', 'Failed to update service: ' . $e->getMessage());
            return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                ->setJSON(['success' => false, 'message' => 'Server error while updating service']);
        }
    }

    /**
     * Soft-delete a service (AJAX endpoint)
     * Sets is_active = 0 and deleted_at = now()
     * Expects POST: id
     */
    public function deleteService()
    {
        // Only allow POST
        $incomingMethod = strtolower($this->request->getMethod());
        if ($incomingMethod !== 'post') {
            return $this->response->setStatusCode(ResponseInterface::HTTP_METHOD_NOT_ALLOWED)
                ->setJSON(['success' => false, 'message' => 'Method not allowed']);
        }
        // Accept either 'id' or legacy 'service_id'
        $id = $this->request->getPost('id');
        if (empty($id)) {
            $id = $this->request->getPost('service_id');
        }

        if (empty($id)) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_UNPROCESSABLE_ENTITY)
                ->setJSON(['success' => false, 'message' => 'Missing service id']);
        }

        // ensure integer
        $id = (int) $id;

        try {
            $db = \Config\Database::connect();
            $builder = $db->table('services');

            // confirm service exists
            $existing = $builder->where('id', $id)->get()->getRowArray();
            if (! $existing) {
                return $this->response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)
                    ->setJSON(['success' => false, 'message' => 'Service not found']);
            }

            $now = date('Y-m-d H:i:s');
            $data = [
                'is_active' => 0,
                'deleted_at' => $now,
            ];

            $ok = $builder->where('id', $id)->update($data);
            if ($ok === false) {
                return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                    ->setJSON(['success' => false, 'message' => 'Failed to delete service']);
            }

            // Re-fetch to confirm
            $after = $builder->where('id', $id)->get()->getRowArray();
            if ($after && isset($after['is_active']) && intval($after['is_active']) === 0) {
                return $this->response->setStatusCode(ResponseInterface::HTTP_OK)
                    ->setJSON(['success' => true, 'message' => 'Service deleted', 'data' => ['id' => $id]]);
            }

            return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                ->setJSON(['success' => false, 'message' => 'Delete did not persist']);
        } catch (\Exception $e) {
            log_message('error', 'Failed to delete service: ' . $e->getMessage());
            return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                ->setJSON(['success' => false, 'message' => 'Server error while deleting service']);
        }
    }
}
