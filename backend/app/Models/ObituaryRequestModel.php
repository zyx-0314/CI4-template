<?php

namespace App\Models;

use CodeIgniter\Model;

class ObituaryRequestModel extends Model
{
    protected $table            = 'obituaryrequests';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'first_name',
        'middle_name',
        'last_name',
        'date_of_birth',
        'date_of_death',
        'profile_image',
        'description',
        'viewing_date_time',
        'viewing_place',
        'funeral_date_time',
        'funeral_place',
        'burial_date_time',
        'burial_place',
        'status',
        'treasured_memories',
        'family',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [
        'id' => 'int',
        // Keep date_of_birth and date_of_death as raw strings (DB uses DATE) to avoid format/Time parsing issues
        // 'date_of_birth' => 'datetime',
        // 'date_of_death' => 'datetime',
        'viewing_date_time' => 'datetime',
        'funeral_date_time' => 'datetime',
        'burial_date_time' => 'datetime',
        // Keep treasured_memories and family as arrays via JSON decode/encode
        'treasured_memories' => 'json',
        'family' => 'json',
    ];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
