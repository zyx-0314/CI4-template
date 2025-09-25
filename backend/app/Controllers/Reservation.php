<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ServicesModel;
use App\Models\RequestsModel;
use CodeIgniter\HTTP\ResponseInterface;

class Reservation extends BaseController
{
    public function showReservationRequestPage($serviceId)
    {
        // Initialize Session
        $session = session();

        // Persist service to database using ServicesModel
        $model = new ServicesModel();

        // Query Builder Select the Data in Database
        $service = $model->where('id', $serviceId)->first();
        // Query Builder Select List the Data in Database
        $services = $model->where('is_active', 1)->where('is_available', 1)->orderBy('id', 'ASC')->findAll();

        // Try to prefill first and last name and email from session user data if present
        $firstName = $session->get('user.first_name') ?? null;
        $lastName = $session->get('user.last_name') ?? null;
        $email = $session->get('user.email') ?? null;

        // If name parts are not present, try to derive from a single 'name' or 'user' value
        if (empty($firstName) || empty($lastName) || empty($email)) {
            $full = $session->get('user.name') ?? $session->get('user') ?? '';
            if (!empty($full)) {
                // If full looks like an email, populate email
                if (filter_var($full, FILTER_VALIDATE_EMAIL) && empty($email)) {
                    $email = $full;
                } else {
                    $parts = preg_split('/\s+/', trim($full));
                    if (empty($firstName)) $firstName = $parts[0] ?? '';
                    if (empty($lastName)) $lastName = $parts[1] ?? ($parts[1] ?? '');
                }
            }
        }

        return view('user/reservation_form', [
            'service' => $service,
            'first_name' => $firstName ?? '',
            'last_name' => $lastName ?? '',
            'email' => $email ?? '',
            'services' => $services,
            'serviceId' => $serviceId,
        ]);
    }

    public function createRequest()
    {
        try {

            // Access service request
            $request = service('request');
            // Initialize Session
            $session = session();

            // Persist request to database using RequestsModel
            $requestModel = new RequestsModel();

            // Assign value from post to variable
            $post = $request->getPost();

            // Basic validation using CI's Validation service
            $validation = \Config\Services::validation();
            $rules = [
                'service_id' => [
                    'label' => 'Service',
                    'rules' => 'required|is_natural_no_zero',
                ],
                'first_name' => [
                    'label' => 'First name',
                    'rules' => 'required|string',
                ],
                'last_name' => [
                    'label' => 'Last name',
                    'rules' => 'required|string',
                ],
                'date_start' => [
                    'label' => 'Start date',
                    'rules' => 'required|valid_date[Y-m-d]',
                ],
                'date_end' => [
                    'label' => 'End date',
                    'rules' => 'required|valid_date[Y-m-d]',
                ],
                'phone' => [
                    'label' => 'Phone',
                    'rules' => 'required_without[email]|string',
                ],
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required_without[phone]|valid_email',
                ],
            ];

            // If no value found from post, notify it is required
            if (!$validation->setRules($rules)->run($post)) {
                $errors = $validation->getErrors();

                // For AJAX clients return JSON like before
                if ($request->isAJAX()) {
                    return $this->response->setJSON([
                        'ok'     => false,
                        'errors' => $errors,
                        'old'    => $post,
                    ])->setStatusCode(422);
                }

                // Otherwise render the form view directly with errors and old input
                $servicesModel = new ServicesModel();
                $service = $servicesModel->find($post['service_id'] ?? null);
                $services = $servicesModel->where('is_active', 1)->orderBy('id', 'ASC')->findAll();

                return view('user/reservation_form', [
                    'service' => $service,
                    'first_name' => $post['first_name'] ?? '',
                    'last_name' => $post['last_name'] ?? '',
                    'email' => $post['email'] ?? '',
                    'services' => $services,
                    'serviceId' => $post['service_id'] ?? null,
                    'errors' => array_values($errors),
                    'fieldErrors' => $errors,
                    'old' => $post,
                ]);
            }

            $dateStart = strtotime($post['date_start']);
            $dateEnd   = strtotime($post['date_end']);
            $minDate   = strtotime('+3 days', strtotime(date('Y-m-d')));

            // Start date must be >= 3 days from now
            if ($dateStart < $minDate) {
                $msg = 'Start date must be at least 3 days from today.';

                if ($request->isAJAX()) {
                    return $this->response->setJSON([
                        'ok' => false,
                        'errors' => ['date_start' => $msg],
                        'old' => $post,
                    ])->setStatusCode(422);
                }

                $servicesModel = new ServicesModel();
                $service = $servicesModel->find($post['service_id'] ?? null);
                $services = $servicesModel->where('is_active', 1)->orderBy('id', 'ASC')->findAll();

                return view('user/reservation_form', [
                    'service' => $service,
                    'first_name' => $post['first_name'] ?? '',
                    'last_name' => $post['last_name'] ?? '',
                    'email' => $post['email'] ?? '',
                    'services' => $services,
                    'serviceId' => $post['service_id'] ?? null,
                    'errors' => [$msg],
                    'fieldErrors' => ['date_start' => $msg],
                    'old' => $post,
                ]);
            }

            // End date must not be earlier than start date
            if ($dateEnd < $dateStart) {
                $msg = 'End date cannot be earlier than start date.';

                if ($request->isAJAX()) {
                    return $this->response->setJSON([
                        'ok'     => false,
                        'errors' => ['date_end' => $msg],
                        'old'    => $post,
                    ])->setStatusCode(422);
                }

                $servicesModel = new ServicesModel();
                $service = $servicesModel->find($post['service_id'] ?? null);
                $services = $servicesModel->where('is_active', 1)->orderBy('id', 'ASC')->findAll();

                return view('user/reservation_form', [
                    'service' => $service,
                    'first_name' => $post['first_name'] ?? '',
                    'last_name' => $post['last_name'] ?? '',
                    'email' => $post['email'] ?? '',
                    'services' => $services,
                    'serviceId' => $post['service_id'] ?? null,
                    'errors' => [$msg],
                    'fieldErrors' => ['date_end' => $msg],
                    'old' => $post,
                ]);
            }


            // Prepare data for insertion
            $saveData = [
                'service_id'          => $post['service_id'],
                'first_name'          => $post['first_name'],
                'last_name'           => $post['last_name'],
                'phone'               => $post['phone'] ?? null,
                'email'               => $post['email'] ?? null,
                'date_start'          => $post['date_start'],
                'date_end'            => $post['date_end'],
                'additional_requests' => $post['additional_requests'] ?? null,
                'status'              => 'pending',
                'is_active'           => 1,
            ];

            // Attach current user id if available in session
            if ($session->has('user')) {
                $saveData['user_id'] = $session->get('user')['id'];
            } else {
                $saveData['user_id'] = null;
            }

            // Insert into DB
            $insertResult = $requestModel->insert($saveData);

            if ($insertResult === false) {
                $msg = 'Could not create request';

                if ($request->isAJAX()) {
                    return $this->response->setJSON([
                        'ok' => false,
                        'errors' => ['general' => $msg],
                        'old' => $post,
                    ])->setStatusCode(500);
                }

                $servicesModel = new ServicesModel();
                $service = $servicesModel->find($post['service_id'] ?? null);
                $services = $servicesModel->where('is_active', 1)->orderBy('id', 'ASC')->findAll();

                return view('user/reservation_form', [
                    'service' => $service,
                    'first_name' => $post['first_name'] ?? '',
                    'last_name' => $post['last_name'] ?? '',
                    'email' => $post['email'] ?? '',
                    'services' => $services,
                    'serviceId' => $post['service_id'] ?? null,
                    'errors' => [$msg],
                    'fieldErrors' => ['general' => $msg],
                    'old' => $post,
                ]);
            }


            // Utilize JSON to transfer feedback into toast
        } catch (\Exception $e) {
            // Utilize JSON to transfer feedback into toast
            return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                ->setJSON(['success' => false, 'message' => 'Server error while creating service: ' . $e->getMessage()]);
        }

        return view('user/reservation_success', ['reservation' => $saveData]);
    }
}
