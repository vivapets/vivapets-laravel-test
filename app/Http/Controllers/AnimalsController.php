<?php

namespace App\Http\Controllers;

use App\Animal;
use App\Http\Resources\AnimalResource;
use Illuminate\Http\Request;

class AnimalsController extends Controller
{
    public function index() {
        return AnimalResource::collection(Animal::paginate());
    }
    
    public function show(Animal $animal) {
        return new AnimalResource($animal);
    }

    public function store(Request $request) {
        $animal = Animal::create($request->all());
        return response()->json(new AnimalResource($animal), 201);
    }

    public function update(Request $request, Animal $animal) {
        $animal->update($request->all());
        return response()->json(new AnimalResource($animal));
    }

    public function delete(Animal $animal) {
        $animal->delete();
        return response()->json(null, 204);
    }
}
