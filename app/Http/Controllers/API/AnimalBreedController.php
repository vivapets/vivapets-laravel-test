<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AnimalBreedResource;
use App\Repositories\Contracts\AnimalBreedRepositoryInterface;

class AnimalBreedController extends Controller
{
    /**
     * Repository that handle all the model stuff
     */
    private $repository;

    public function __construct(AnimalBreedRepositoryInterface $breed)
    {
        $this->repository = $breed;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AnimalBreedResource::collection($this->repository->paginate());
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
        return response()->json(new AnimalBreedResource($type), 201);   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new AnimalBreedResource($this->repository->find($id));
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
        $this->repository->update($request->all());
        return response()->json(new AnimalBreedResource($this->repository->find($id)));
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
