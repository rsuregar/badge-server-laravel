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
                "hashed" => true,
                "salt" => $assertion->entity_id,
                "identity" => "sha256$".hash('sha256', $assertion->recipient_email.$assertion->entity_id),
                // 'email' => hash('sha256', $assertion->recipient_email.$assertion->entity_id),
            ],
            'badge' => route('badgeClass.show', $assertion->badge_class_uuid),
            'verification' => [
                'type' => $assertion->verification_type,
                'url' => $assertion->verification_url,
                'publicKey' => $assertion->verification_public_key,
            ],
            'issuedOn' => $assertion->issued_on,
            'expires' => $assertion->expires_on,
            'evidence' => $assertion->evidence,
            'revoked' => $assertion->revoked,
            'revocationReason' => $assertion->revocation_reason,
            'narrative' => $assertion->narrative,
            'attachments' => $assertion->attachments
        ];
        return response()->json($data, 200);
    }

}
