<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Resources\AnimalResource;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserController extends Controller
{
    /**
     * Repository that handle all the model stuff
     */
    private $repository;

    public function __construct(UserRepositoryInterface $user)
    {
        $this->repository = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserResource::collection($this->repository->onlyRegularUsers()->paginate());
    }

    /**
     * Display a listing of animals of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function animals(Request $request, $id)
    {
        return AnimalResource::collection($this->repository->animals()->paginate());
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
