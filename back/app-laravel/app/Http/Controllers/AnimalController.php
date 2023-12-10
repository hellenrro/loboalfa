<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ImagePet;
use App\Models\Pets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnimalController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $colorFilter = $request->input('color');
        $sizeFilter = $request->input('size');
        $ageFilter = $request->input('age');

        $query = Pets::with('imgPets');

        if ($colorFilter) {
            $query->where('color', $colorFilter);
        }

        if ($sizeFilter) {
            $query->where('size', $sizeFilter);
        }

        if ($ageFilter) {
            $query->where('age', $ageFilter);
        }

        $pets = $query->get();

        $formattedPets = $pets->map(function ($pet) {
            $images = $pet->imgPets->pluck('name')->toArray();

            return [
                'name' => $pet->name,
                'color' => $pet->color,
                'size' => $pet->size,
                'age' => $pet->age,
                'description' => $pet->description,
                'id' => $pet->id,
                'img' => $images,
            ];
        });

        return ['data' => $formattedPets, 'success' => true];
    }

    public function store(Request $request)
    {
//        if (Auth::check()) {
            $request->validate([
                'name' => 'required|string',
                'description' => 'required|string'
            ]);

            $newPet = new Pets;
            $newPet->name = $request->input('name');
            $newPet->description = $request->input('description');
            $newPet->color = $request->input('color');
            $newPet->age = $request->input('age');
            $newPet->size = $request->input('size');
            $newPet->highlight = 0;
            $newPet->save();
            if ($request->hasFile('img')) {
                $images = $request->file('img');
                foreach ($images as $image) {
                    $imageName = time() . '.' . $image->getClientOriginalExtension();
                    $image->storeAs('pets', $imageName, 'public');
                    $imgPet = new ImagePet();
                    $imgPet->id_pet = $newPet->id;
                    $imgPet->name = $imageName;
                    $imgPet->save();
                }
            }
            return ['message' => 'Pet criado com sucesso', 'success' => true];
//        } else {
//            return response()->json(['message' => 'Sem permissão'], 200);
//        }
    }

    public function edit(Request $request, $id)
    {
        $pet = Pets::find($id);

        if (!$pet) {
            return ['message' => 'Pet não encontrado', 'success' => false];
        }

        $request->validate([
            'name' => 'string',
            'description' => 'string',
        ]);

        $pet->name = $request->input('name');
        $pet->description = $request->input('description');
        $pet->save();

        return ['message' => 'Pet atualizado com sucesso', 'success' => true];
    }

    public function destroy($id)
    {
        $pet = Pets::find($id);

        if (!$pet) {
            return ['message' => 'Pet não encontrado', 'success' => false];
        }

        $imgPet = $pet->img;

        if ($imgPet) {
            $path = storage_path('app/public/pets/' . $imgPet);

            if (file_exists($path)) {
                unlink($path);
            }
        }
        $pet->delete();

        return ['message' => 'Pet deletado com sucesso', 'success' => true];
    }
}
