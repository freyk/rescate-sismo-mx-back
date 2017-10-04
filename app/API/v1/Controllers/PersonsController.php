<?php

namespace App\API\v1\Controllers;

use Illuminate\Http\Request;
use App\API\v1\Models\Person;
use App\Http\ApiResponse;
use App\Http\Controllers\ApiController;
use App\API\v1\Transformers\PersonCollectionTransformer;
use App\API\v1\Transformers\PersonItemTransformer;

class PersonsController extends ApiController
{
    /**
     * The Http Request.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * The ApiResponse.
     *
     * @var \App\Http\ApiResponse
     */
    protected $apiResponse;

    /**
     * The Person Model.
     *
     * @var \App\API\v1\Models\Person
     */
    protected $person;


    public function __construct(
        Request $request,
        ApiResponse $apiResponse,
        Person $person
    ) {
        $this->apiResponse = $apiResponse;
        $this->request = $request;
        $this->person = $person;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\ApiResponse
     */
    public function index()
    {
        $persons = $this->person->all();

        return $this->apiResponse->withCollection($persons, new PersonCollectionTransformer);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\ApiResponse
     */
    public function search(Request $request)
    {
       $term = $request->get('q');
       $persons = Person::search('Marco Antonio Pedraza Acuña', null, true)->get();

       return view('resultados-busqueda', compact('persons', 'term'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
