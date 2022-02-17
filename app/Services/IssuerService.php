<?php

namespace App\Services;

use App\Models\Issuer;

class IssuerService
{
    protected $content = "https://w3id.org/openbadges/v2";

    public function getIssuerByUuid(string $uuid)
    {
        $issuer = Issuer::where('uuid', $uuid)->first();
        if (!$issuer) {
            return response()->json(['message' => 'Issuer not found', 'code' => 404], 404);
        }
        $data = [
            '@content' => $this->content,
            'type' => "Issuer",
            'id' => route('issuer.show', $issuer->uuid),
            'name' => $issuer->name,
            'url' => $issuer->website,
            'email' => $issuer->email,
            'description' => $issuer->description,
            'image' => $issuer->image,
            'additionalData' => [
                'organization' => [
                    'type' => $issuer->organization_type,
                    'name' => $issuer->organization_name,
                    'address' => $issuer->organization_address,
                    'public_id' => $issuer->public_key,
                ],
            ]
        ];
        return response()->json($data, 200);
    }

    public function getIssuerByUserId(string $userId)
    {
        $issuers = Issuer::where('user_id', $userId)->get();
        if ($issuers->isEmpty()) {
            return response()->json(['message' => 'Issuer not found', 'code' => 404], 404);
        }

        $data = [];
        foreach ($issuers as $key => $issuer) {
            $data[] = [
                '@content' => $this->content,
                'type' => "Issuer",
                'id' => route('issuer.index').'/'.$issuer->uuid,
                'name' => $issuer->name,
                'url' => $issuer->website,
                'email' => $issuer->email,
                'description' => $issuer->description,
                'image' => $issuer->image,
                'additionalData' => [
                    'organization' => [
                        'type' => $issuer->organization_type,
                        'name' => $issuer->organization_name,
                        'address' => $issuer->organization_address,
                        'public_id' => $issuer->public_key,
                    ],
                ]
            ];
        }

        return response()->json($data, 200);;
    }
}
