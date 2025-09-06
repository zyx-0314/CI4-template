<?php

namespace App\Controllers;

use App\Models\ServicesModel;

class Services extends BaseController
{
    public function index()
    {
        $model = new ServicesModel();
        try {
            $rows = $model->where('is_active', 1)->where('is_available', 1)->orderBy('id', 'ASC')->findAll();
        } catch (\Throwable $e) {
            $rows = [];
        }

        $services = array_map(function ($r) {
            return [
                'id' => $r['id'],
                'title' => $r['title'],
                'summary' => isset($r['description']) ? (mb_strlen($r['description']) > 140 ? mb_substr($r['description'], 0, 140) . '...' : $r['description']) : '',
                'cost' => $r['cost'],
            ];
        }, $rows);

        return view('services/index', ['services' => $services]);
    }

    public function show(string $slug)
    {
        // If segment is numeric, try DB lookup by id first
        if (is_numeric($slug)) {
            $model = new ServicesModel();
            $row = $model->find((int) $slug);
            if (! empty($row) && (isset($row['is_active']) ? (int)$row['is_active'] === 1 : true)) {
                $data = [
                    'title' => $row['title'],
                    'description' => $row['description'],
                    'inclusions' => $row['inclusions'],
                    'cost' => $row['cost'],
                    'id' => $row['id'],
                ];

                return view('services/show', $data);
            }

            return redirect()->to('/services');
        }

        // Static lookup
        $map = [
            'traditional-filipino' => [
                'title' => 'Traditional Filipino',
                'description' => 'Traditional Filipino funeral services including wakes, vigils, and full burial logistics.',
                'inclusions' => 'embalming,coffin,transport,prayers,burial-permit',
                'cost' => '1200.00',
            ],
            'cremation' => [
                'title' => 'Cremation',
                'description' => 'Cremation package with memorial service and urn options.',
                'inclusions' => 'cremation,urn,memorial-service,transport',
                'cost' => '800.00',
            ],
            'green-burial' => [
                'title' => 'Green Burial',
                'description' => 'Environmentally friendly burial option with biodegradable materials.',
                'inclusions' => 'biodegradable-coffin,transport,burial-permit',
                'cost' => '900.00',
            ],
            'hybrid-funeral' => [
                'title' => 'Hybrid Funeral',
                'description' => 'A hybrid service combining elements of burial and cremation.',
                'inclusions' => 'custom-options,transport,service-coordination',
                'cost' => '1000.00',
            ],
        ];

        if (! array_key_exists($slug, $map)) {
            return redirect()->to('/services');
        }

        $data = $map[$slug];
        $data['slug'] = $slug;

        return view('services/show', $data);
    }
}
