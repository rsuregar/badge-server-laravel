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
            'extensions' => $badgeClass->extensions,
        ];
        return response()->json($data, 200);
    }
}
