<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ServicesModel;
use App\Models\FuneralRequestModel;

class Admin extends BaseController
{
    public function dashboard()
    {
        // Gather simple counts for the admin dashboard. If tables or DB
        // are not available yet, fall back to zero so the UI stays stable.
        $servicesModel = new ServicesModel();
        $funeralModel  = new FuneralRequestModel();

        $totalServices   = 0;
        $totalInquiries  = 0;
        $upcomingServices = 0;

        try {
            $totalServices = $servicesModel->countAllResults();
        } catch (\Throwable $e) {
            // ignore and leave default 0
        }

        try {
            $totalInquiries = $funeralModel->countAllResults();
            $today = date('Y-m-d');
            $upcomingServices = $funeralModel
                ->where('preferred_date >=', $today)
                ->where('status !=', 'completed')
                ->countAllResults();
        } catch (\Throwable $e) {
            // ignore and leave defaults
        }

        return view('admin/dashboard', [
            'totalServices'    => $totalServices,
            'totalInquiries'   => $totalInquiries,
            'upcomingServices' => $upcomingServices,
        ]);
    }

    /**
     * Show admin services management (static for now)
     */
    public function services()
    {
        $model = new ServicesModel();
        // For the admin view we still render the static page; the frontend will call the API endpoints below.
        return view('admin/services');
    }

    /**
     * API: return JSON list of services
     */
    public function servicesList()
    {
        $model = new ServicesModel();

        // Pagination params (GET)
        $page = (int) $this->request->getGet('page') ?: 1;
        $perPage = (int) $this->request->getGet('per_page') ?: 5;
        if ($page < 1) $page = 1;
        if ($perPage < 1) $perPage = 5;

        try {
            // Build a base query using the model's builder so we can get a total count
            // Only include active services for the admin listing
            $builder = $model->builder();
            $builder->where('is_active', 1);
            $builder->orderBy('id', 'ASC');

            // total rows for the query (before limit)
            $total = (int) $builder->countAllResults(false);

            $offset = ($page - 1) * $perPage;
            $rows = $builder->limit($perPage, $offset)->get()->getResultArray();

            $totalPages = $perPage > 0 ? (int) ceil($total / $perPage) : 1;

            // Compute some useful counts for the admin UI (avoid modifying the builder state)
            $countsModel = new ServicesModel();
            $activeTotal = (int) $countsModel->where('is_active', 1)->countAllResults();
            $availableActive = (int) (new ServicesModel())->where('is_active', 1)->where('is_available', 1)->countAllResults();
            $unavailableActive = (int) (new ServicesModel())->where('is_active', 1)->where('is_available', 0)->countAllResults();

            return $this->response->setJSON([
                'ok' => true,
                'data' => $rows,
                'meta' => [
                    'total' => $total,
                    'page' => $page,
                    'per_page' => $perPage,
                    'total_pages' => $totalPages,
                    'counts' => [
                        'active_total' => $activeTotal,
                        'available_active' => $availableActive,
                        'unavailable_active' => $unavailableActive,
                    ],
                ],
            ]);
        } catch (\Throwable $e) {
            return $this->response->setStatusCode(500)->setJSON(['ok' => false, 'error' => $e->getMessage()]);
        }
    }

    /**
     * API: store a new service (POST)
     */
    public function storeService()
    {
        $model = new ServicesModel();
        $data = $this->request->getPost();

        // Basic sanitation - in real app validate properly
        $payload = [
            'title' => $data['title'] ?? null,
            'description' => $data['description'] ?? null,
            'inclusions' => $data['inclusions'] ?? null,
            'cost' => $data['cost'] ?? 0,
            // is_active retained for legacy behaviour (defaults to 1)
            'is_active' => isset($data['is_active']) ? (int) $data['is_active'] : 1,
            // default to 0 when not explicitly provided
            'is_available' => isset($data['is_available']) ? (int) $data['is_available'] : 0,
        ];

        try {
            $id = $model->insert($payload);
            return $this->response->setJSON(['ok' => true, 'id' => $id]);
        } catch (\Throwable $e) {
            return $this->response->setStatusCode(500)->setJSON(['ok' => false, 'error' => $e->getMessage()]);
        }
    }

    /**
     * API: update service (POST)
     */
    public function updateService($id = null)
    {
        if (empty($id)) {
            return $this->response->setStatusCode(400)->setJSON(['ok' => false, 'error' => 'missing id']);
        }

        $model = new ServicesModel();
        $data = $this->request->getPost();

        $payload = [
            'title' => $data['title'] ?? null,
            'description' => $data['description'] ?? null,
            'inclusions' => $data['inclusions'] ?? null,
            'cost' => $data['cost'] ?? 0,
            'is_active' => isset($data['is_active']) ? (int) $data['is_active'] : 1,
            'is_available' => isset($data['is_available']) ? (int) $data['is_available'] : 0,
        ];

        try {
            $model->update($id, $payload);
            return $this->response->setJSON(['ok' => true]);
        } catch (\Throwable $e) {
            return $this->response->setStatusCode(500)->setJSON(['ok' => false, 'error' => $e->getMessage()]);
        }
    }

    /**
     * API: delete (soft delete) service
     */
    public function deleteService($id = null)
    {
        if (empty($id)) {
            return $this->response->setStatusCode(400)->setJSON(['ok' => false, 'error' => 'missing id']);
        }

        $model = new ServicesModel();
        try {
            // Instead of removing the row, mark it as not available and not active
            // so the record remains in the DB but is considered deleted/disabled.
            $model->update($id, ['is_available' => 0, 'is_active' => 0]);
            return $this->response->setJSON(['ok' => true]);
        } catch (\Throwable $e) {
            return $this->response->setStatusCode(500)->setJSON(['ok' => false, 'error' => $e->getMessage()]);
        }
    }
}
