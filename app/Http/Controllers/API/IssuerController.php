<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Issuer;
use App\Services\IssuerService;

class IssuerController extends Controller
{
    protected $issuerService;
    function __construct(IssuerService $issuerService)
    {
        $this->issuerService = $issuerService;
    }

    public function index()
    {
        return $this->issuerService->getIssuerByUserId(auth()->id() ?? 1);
    }

    public function store(Request $request)
    {
        // return $request->all();
        $issuer = Issuer::create($request->all());
        return response()->json($issuer, 201);
    }

    public function show($uuid)
    {
        return $this->issuerService->getIssuerByUuid($uuid);
    }


}
