<?php

namespace App\Http\Controllers\API;

use Cache;
use App\Models\AnimalType;
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

    /**
     * Cache key name
     */
    protected $cacheKey = 'animals_types_list';

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
        if (Cache::has($this->cacheKey)) {
            return Cache::get($this->cacheKey);
        }

        $resource = AnimalTypeResource::collection($this->repository->paginate());
        Cache::put($this->cacheKey, $resource);
        
        return $resource;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(AnimalType::$rules);

        Cache::forget($this->cacheKey);
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
        if (Cache::has($this->cacheKey . $id)) {
            return Cache::get($this->cacheKey . $id);
        }

        $resource = new AnimalTypeResource($this->repository->find($id));
        Cache::put($this->cacheKey . $id, $resource);
        return $resource;
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
        $request->validate(AnimalType::$rules);
        Cache::forget($this->cacheKey);
        Cache::forget($this->cacheKey . $id);
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
        Cache::forget($this->cacheKey);
        Cache::forget($this->cacheKey . $id);
        $this->repository->delete();
        return response()->json(null, 204);
    }
}
