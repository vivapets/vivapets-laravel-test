<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AnimalTypeResource;
use App\Repositories\Contracts\AnimalTypeRepositoryInterface;

class AnimalTypeController extends Controller
{
    /**
     * Repository that handle all the model stuff
     */
    private $repository;

    public function __construct(AnimalTypeRepositoryInterface $type)
    {
        $this->repository = $type;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AnimalTypeResource::collection($this->repository->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $type = $this->repository->create($request->all());
        return response()->json(new AnimalTypeResource($type), 201);   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new AnimalTypeResource($this->repository->find($id));
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
        dd($this->repository);
        $this->repository->update($request->all());
        return response()->json(new AnimalTypeResource($this->repository->find($id)));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->delete();
        return response()->json(null, 204);
    }
}
