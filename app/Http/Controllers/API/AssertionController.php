<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Assertion;
use Illuminate\Http\Request;
use App\Services\AssertionService;

class AssertionController extends Controller
{
    protected $assertionService;

    function __construct(AssertionService $assertionService)
    {
        $this->assertionService = $assertionService;
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
        // return $request;
        $data = Assertion::create($request->all());
        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Assertion  $assertion
     * @return \Illuminate\Http\Response
     */
    public function show($assertion)
    {
        $assertion = Assertion::where('uuid', $assertion)->first();
        return $this->assertionService->getAssertionByUuid($assertion->uuid);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Assertion  $assertion
     * @return \Illuminate\Http\Response
     */
    public function edit(Assertion $assertion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Assertion  $assertion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assertion $assertion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Assertion  $assertion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assertion $assertion)
    {
        //
    }
}
