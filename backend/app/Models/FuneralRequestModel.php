<?php
namespace App\Models;

use CodeIgniter\Model;

class FuneralRequestModel extends Model
{
    protected $table = 'funeral_requests';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'first_name', 'last_name', 'email', 'phone', 'service_type', 'preferred_date', 'preferred_time', 'address', 'notes', 'status'
    ];

    protected $useTimestamps = true;
    protected $returnType = 'App\Entities\FuneralRequest';
    protected $validationRules = [
    'first_name' => 'required|min_length[2]|max_length[191]',
    'last_name'  => 'permit_empty|max_length[191]',
        'service_type' => 'required|max_length[100]',
        'email' => 'valid_email|max_length[191]',
        'phone' => 'max_length[50]'
    ];
}
