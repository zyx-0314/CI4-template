<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\IncomingRequest;

class Reservation extends BaseController
{
    private $DUMMY_SERVICES = [
        ['id' => 1, 'title' => 'Basic Funeral Package', 'description' => 'Simple service with chapel of rest', 'cost' => 15000, 'is_available' => 1, 'is_active' => 1, 'inclusions' => 'Chapel,Hearse,Flowers'],
        ['id' => 2, 'title' => 'Standard Funeral Package', 'description' => 'Includes viewing and basic catering', 'cost' => 30000, 'is_available' => 1, 'is_active' => 1, 'inclusions' => 'Chapel,Hearse,Catering'],
        ['id' => 4, 'title' => 'Cremation Service', 'description' => 'Cremation-only service', 'cost' => 12000, 'is_available' => 1, 'is_active' => 1, 'inclusions' => 'Cremation Certificate'],
        ['id' => 5, 'title' => 'Memorial Only', 'description' => 'Memorial service without remains', 'cost' => 8000, 'is_available' => 1, 'is_active' => 1, 'inclusions' => 'Venue,Sound System'],
        ['id' => 7, 'title' => 'Express Service', 'description' => 'Quick handling and burial', 'cost' => 7000, 'is_available' => 1, 'is_active' => 1, 'inclusions' => 'Hearse'],
        ['id' => 8, 'title' => 'Deluxe with Reception', 'description' => 'Includes reception after service', 'cost' => 45000, 'is_available' => 1, 'is_active' => 1, 'inclusions' => 'Reception,Catering,Program'],
    ];

    public function create()
    {
        $serviceId = $this->request->getGet('service_id');

        $service = null;
        foreach ($this->DUMMY_SERVICES as $s) {
            if ((string) $s['id'] === (string) $serviceId) {
                $service = $s;
                break;
            }
        }

        // Try to prefill first and last name and email from session user data if present
        $session = session();
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
            'services' => $this->DUMMY_SERVICES
        ]);
    }

    public function store()
    {
        $post = $this->request->getPost();

        $data = [
            'service_id' => $post['service_id'] ?? null,
            'first_name' => $post['first_name'] ?? null,
            'last_name' => $post['last_name'] ?? null,
            'phone' => $post['phone'] ?? null,
            'email' => $post['email'] ?? null,
            'date_start' => $post['date_start'] ?? null,
            'date_end' => $post['date_end'] ?? null,
            'additional_requests' => $post['additional_requests'] ?? null,
            // For demo, don't store real credit card. We'll mask it.
            'cc_last4' => isset($post['cc_number']) ? substr(preg_replace('/\D/', '', $post['cc_number']), -4) : null,
            'cc_name' => $post['cc_name'] ?? null,
        ];

        // Minimal validation
        $errors = [];
        if (empty($data['first_name'])) $errors[] = 'First name is required.';
        if (empty($data['last_name'])) $errors[] = 'Last name is required.';
        if (empty($data['phone'])) $errors[] = 'Phone number is required.';
        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required.';
        if (empty($data['date_start'])) $errors[] = 'Start date is required.';
        if (empty($data['date_end'])) $errors[] = 'End date is required.';

        // Demo payment validations (lightweight)
        if (empty($post['cc_name'])) $errors[] = 'Name on card is required.';
        if (empty($post['cc_cvv'])) $errors[] = 'CVV is required.';
        else {
            $cvv = preg_replace('/\D/', '', $post['cc_cvv']);
            if (!preg_match('/^\d{3,4}$/', $cvv)) $errors[] = 'CVV must be 3 or 4 digits.';
        }
        if (empty($post['cc_expiry'])) $errors[] = 'Expiry is required.';
        else {
            if (!preg_match('/^(0[1-9]|1[0-2])\/[0-9]{2}$/', $post['cc_expiry'])) $errors[] = 'Expiry must be in MM/YY format.';
        }

        if (!empty($errors)) {
            // Try to find the service to re-render the form context
            $service = null;
            $serviceId = $post['service_id'] ?? null;
            foreach ($this->DUMMY_SERVICES as $s) {
                if ((string)$s['id'] === (string)$serviceId) {
                    $service = $s;
                    break;
                }
            }

            // Map common error messages to field keys for inline display
            $fieldErrors = [];
            foreach ($errors as $msg) {
                if (stripos($msg, 'first name') !== false || stripos($msg, 'first_name') !== false) $fieldErrors['first_name'] = $msg;
                if (stripos($msg, 'last name') !== false || stripos($msg, 'last_name') !== false) $fieldErrors['last_name'] = $msg;
                if (stripos($msg, 'phone') !== false) $fieldErrors['phone'] = $msg;
                if (stripos($msg, 'email') !== false) $fieldErrors['email'] = $msg;
                if (stripos($msg, 'start date') !== false || stripos($msg, 'start') !== false) $fieldErrors['date_start'] = $msg;
                if (stripos($msg, 'end date') !== false || stripos($msg, 'end') !== false) $fieldErrors['date_end'] = $msg;
                // Payment related mappings
                if (stripos($msg, 'name on card') !== false || stripos($msg, 'name on card') !== false || stripos($msg, 'name on card') !== false) $fieldErrors['cc_name'] = $msg;
                if (stripos($msg, 'cvv') !== false) $fieldErrors['cc_cvv'] = $msg;
                if (stripos($msg, 'expiry') !== false || stripos($msg, 'expir') !== false) $fieldErrors['cc_expiry'] = $msg;
            }

            return view('user/reservation_form', [
                'errors' => $errors,
                'fieldErrors' => $fieldErrors,
                'old' => $post,
                'services' => $this->DUMMY_SERVICES,
                'service' => $service,
                'first_name' => $post['first_name'] ?? '',
                'last_name' => $post['last_name'] ?? '',
                'email' => $post['email'] ?? ''
            ]);
        }

        // Store reservation in session as demo
        $session = session();
        $reservations = $session->get('reservations') ?? [];
        $reservations[] = $data + ['created_at' => date('c')];
        $session->set('reservations', $reservations);

        return view('user/reservation_success', ['reservation' => $data]);
    }
}
