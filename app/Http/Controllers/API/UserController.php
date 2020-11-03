<?php

namespace App\Http\Controllers\API;

use Cache;
use App\Models\UserType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;
use App\Http\Resources\AnimalResource;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserController extends Controller
{
    /**
     * Repository that handle all the model stuff
     */
    private $repository;

    /**
     * Cache key name
     */
    protected $cacheKey = 'users_list';

    public function __construct(UserRepositoryInterface $user)
    {
        $this->repository = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Resources\UserResource
     */
    public function index(Request $request)
    {
        /**
         * Only admin user can see this method
         */
        
        if($request->user()->type_id != UserType::ADMIN_USER_TYPE_ID) {
            return response()->json([
                'message' => 'Only admin users can see other users'
            ], 401);
        }

        if (Cache::has($this->cacheKey)) {
            return Cache::get($this->cacheKey);
        }

        $resource = UserResource::collection($this->repository->onlyRegularUsers()->paginate());
        Cache::put($this->cacheKey, $resource);
        
        return $resource;
    }

    /**
     * Display a listing of animals of the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param   $id
     * @return App\Http\Resources\AnimalResource
     */
    public function animals(Request $request, $id)
    {
        $cacheKey = $this->cacheKey . 'animals' . $id;
        if (Cache::has($cacheKey)) {
            // return Cache::get($cacheKey);
        }

        $resource = AnimalResource::collection($this->repository->animals()->paginate());
        Cache::put($cacheKey, $resource);
        
        return $resource;
    }

    /**
     * Ban a user and prevent him to login
     *
     * @param  \Illuminate\Http\Request  $request
     * @param   $id
     * @return App\Http\Resources\AnimalResource
     */
    public function ban(Request $request, $id)
    {
        Cache::forget($this->cacheKey);
        $this->repository->ban();
        return response()->json([
            'message' => 'ok'
        ], 200);
    }

    /**
     * Returns the current logged in user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return App\Http\Resources\UserResource
     */
    public function user(Request $request)
    {
        if (Auth::check()) {
            return response()->json([
                'message' => 'User not logged in'
            ], 403);
        }

        return new UserResource($request->user());
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json(null, 501);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(null, 501);
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
        return response()->json(null, 501);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->json(null, 501);
    }
}
