<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pets;
use Illuminate\Http\Request;

class AnimalController extends Controller {

    public function index()
    {
        $pets = Pets::all();

        $formattedPets = $pets->map(function ($pet) {
            return [
                'name' => $pet->name,
                'description' => $pet->description,
                'id' => $pet->id,
                'img' => $pet->img ??  null
            ];
        });

        return ['data' => $formattedPets, 'success' => true];
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'img' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $newPet = new Pets;
        $newPet->name = $request->input('name');
        $newPet->description = $request->input('description');
        $newPet->highlight = 0;
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('pets', $imageName, 'public');

            $newPet->img = $imageName;
        }
        $newPet->save();

        return ['message' => 'Pet criado com sucesso', 'success' => true];
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
