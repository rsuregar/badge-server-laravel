<?php

namespace App\Services;

use App\Models\Assertion;

class AssertionService
{
    protected $content = "https://w3id.org/openbadges/v2";

    public function getAssertionByUuid(string $uuid)
    {
        $assertion = Assertion::where('uuid', $uuid)->first();
        if (!$assertion) {
            return response()->json(['message' => 'Assertion not found', 'code' => 404], 404);
        }
        $data = [
            '@context' => $this->content,
            'type' => "Assertion",
            'id' => route('assertion.show', $assertion->uuid),
            'recipient' => [
                "type" => "email",
                "salt" => $assertion->entity_id,
                "hashed" => true,
                "identity" => "sha256$".hash('sha256', $assertion->recipient_email.$assertion->entity_id),
            ],
            'image' => [
                'id' => $assertion->image,
            ],
            'issuedOn' => $assertion->issued_on,
            'expires' => $assertion->expires_on,
            'evidence' => $assertion->evidence,
            'revoked' => $assertion->revoked ?? false,
            'revocationReason' => $assertion->revocation_reason,
            'narrative' => $assertion->narrative,
            'badge' => route('badgeClass.show', [$assertion->badge->issuer_uuid, $assertion->badge_class_uuid]),
            'verification' => [
                'type' => $assertion->verification_type,
            ],
            'extensions.recipientProfile' => [
                '@context' => "https://openbadgespec.org/extensions/recipientProfile/context.json",
                'name' => $assertion->recipient_name,
                'type' => [
                    "Extension",
                    "extensions:RecipientProfile",
                ]
            ],
        ];
        return response()->json($data, 200);
    }
}
