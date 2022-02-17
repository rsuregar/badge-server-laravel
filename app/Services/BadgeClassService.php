<?php

namespace App\Services;

use App\Models\BadgeClass;

class BadgeClassService
{
    protected $content = "https://w3id.org/openbadges/v2";

    public function getBadgeClassByUuid(string $uuid)
    {
        $badgeClass = BadgeClass::where('uuid', $uuid)->first();
        if (!$badgeClass) {
            return response()->json(['message' => 'BadgeClass not found', 'code' => 404], 404);
        }
        $data = [
            '@context' => $this->content,
            'type' => "BadgeClass",
            'id' => route('badgeClass.show', [$badgeClass->issuer_uuid, $badgeClass->uuid]),
            'name' => $badgeClass->name,
            'description' => $badgeClass->description,
            'image' => $badgeClass->image,
            'criteria' => "https://rsuregar.my.id",
            'issuer' => route('issuer.show', $badgeClass->issuer_uuid),
            'tags' => $badgeClass->tags,
            'alignment' => $badgeClass->alignment,
            'issuance' => [
                'type' => $badgeClass->issuance_type,
                'count' => $badgeClass->issuance_count,
                'earn' => $badgeClass->issuance_earn,
                'revoked' => $badgeClass->issuance_revoked,
            ],
            'related' => [
                'badge' => $badgeClass->related_badge,
                'evidence' => $badgeClass->related_evidence,
            ],
            'extensions' => $badgeClass->extensions,
        ];
        return response()->json($data, 200);
    }
}
