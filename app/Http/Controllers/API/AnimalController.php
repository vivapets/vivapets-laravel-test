<?php

namespace App\Http\Controllers\API;

use Cache;
use Storage;
use App\Models\Animal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AnimalResource;
use App\Repositories\Contracts\AnimalRepositoryInterface;

class AnimalController extends Controller
{
    /**
     * Repository that handle all the model stuff
     */
    private $repository;

    /**
     * Cache key name
     */
    protected $cacheKey = 'animals_list';

    /**
     * Cache key name for users
     */
    protected $cacheKeyUsers = 'users_list';

    public function __construct(AnimalRepositoryInterface $animal)
    {
        $this->repository = $animal;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user()->id;
        if (Cache::has($this->cacheKey)) {
            return Cache::get($this->cacheKey);
        }

        $resource = AnimalResource::collection($request->user()->animals()->paginate());
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
        $request->validate(Animal::$rules);
        $user = $request->user()->id;

        Cache::forget($this->cacheKey);
        $data = $request->all();
        $data['user_id'] = $request->user()->id;

        $cacheKey = $this->cacheKeyUsers . 'animals' . $user;
        Cache::forget($cacheKey);

        if($request->hasFile('photo')) { 
            $path = $request->file('photo')->store('public/animals');
            $data['photo'] = Storage::url($path);
        } else {
            unset($data['photo']);
        }

        $animal = $this->repository->create($data);
        return response()->json(new AnimalResource($animal), 201);   
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

        $resource = new AnimalResource($this->repository->find($id));
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
        Cache::forget($this->cacheKey);
        Cache::forget($this->cacheKey . $id);

        $data = $request->all();
        $data['user_id'] = $request->user()->id;

        if($request->hasFile('photo')) { 
            $path = $request->file('photo')->store('public/animals');
            $data['photo'] = Storage::url($path);
        } else {
            unset($data['photo']);
        }
        
        $this->repository->update($data);
        return response()->json(new AnimalResource($this->repository->find($id)));
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
