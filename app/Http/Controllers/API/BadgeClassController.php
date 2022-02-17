<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\BadgeClass;
use Illuminate\Http\Request;
use App\Services\BadgeClassService;

class BadgeClassController extends Controller
{

    protected $badgeClassService;
    public function __construct(BadgeClassService $badgeClassService)
    {
        $this->badgeClassService = $badgeClassService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = BadgeClass::create($request->all());
        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BadgeClass  $badgeClass
     * @return \Illuminate\Http\Response
     */
    public function show(BadgeClass $badgeClass)
    {
        return $this->badgeClassService->getBadgeClassByUuid($badgeClass->uuid);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BadgeClass  $badgeClass
     * @return \Illuminate\Http\Response
     */
    public function edit(BadgeClass $badgeClass)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BadgeClass  $badgeClass
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BadgeClass $badgeClass)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BadgeClass  $badgeClass
     * @return \Illuminate\Http\Response
     */
    public function destroy(BadgeClass $badgeClass)
    {
        //
    }
}
