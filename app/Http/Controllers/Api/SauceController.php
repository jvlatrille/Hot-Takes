<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sauce;
use App\Http\Resources\SauceResource;
use Illuminate\Http\Request;

class SauceController extends Controller
{
    // GET /api/sauces : liste toutes les sauces
    public function index()
    {
        $sauces = Sauce::all();
        return SauceResource::collection($sauces);
    }

    // GET /api/sauces/{sauce} : retourne le détail d'une sauce
    public function show(Sauce $sauce)
    {
        return new SauceResource($sauce);
    }

    // POST /api/sauces : crée une nouvelle sauce
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'         => 'required|string|max:255',
            'manufacturer' => 'required|string|max:255',
            'description'  => 'required|string',
            'mainPepper'   => 'required|string',
            'heat'         => 'required|integer|min:1|max:10',
            'imageUrl'     => 'nullable|url'
        ]);

        $sauce = new Sauce();
        $sauce->name = $data['name'];
        $sauce->manufacturer = $data['manufacturer'];
        $sauce->description = $data['description'];
        // Remarque : Assure-toi que ton modèle utilise les bons noms (par exemple main_pepper ou mainPepper)
        $sauce->mainPepper = $data['mainPepper'];
        $sauce->heat = $data['heat'];
        $sauce->imageUrl = $data['imageUrl'] ?? null;
        // Le propriétaire est l'utilisateur connecté
        $sauce->user_id = $request->user()->id;
        $sauce->likes = 0;
        $sauce->dislikes = 0;
        $sauce->usersLiked = [];
        $sauce->usersDisliked = [];
        $sauce->save();

        return new SauceResource($sauce);
    }

    // PUT /api/sauces/{sauce} : met à jour une sauce
    public function update(Request $request, Sauce $sauce)
    {
        // Vérifier que l'utilisateur connecté est bien le propriétaire
        if ($sauce->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Action non autorisée'], 403);
        }

        $data = $request->validate([
            'name'         => 'sometimes|string|max:255',
            'manufacturer' => 'sometimes|string|max:255',
            'description'  => 'sometimes|string',
            'mainPepper'   => 'sometimes|string',
            'heat'         => 'sometimes|integer|min:1|max:10',
            'imageUrl'     => 'sometimes|nullable|url'
        ]);

        foreach ($data as $field => $value) {
            $sauce->$field = $value;
        }
        $sauce->save();

        return new SauceResource($sauce);
    }

    // DELETE /api/sauces/{sauce} : supprime une sauce
    public function destroy(Request $request, Sauce $sauce)
    {
        if ($sauce->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Action non autorisée'], 403);
        }

        $sauce->delete();
        return response()->json(['message' => 'Sauce supprimée !'], 200);
    }

    // POST /api/sauces/{sauce}/like : gérer like/dislike
    public function likeOrDislike(Request $request, Sauce $sauce)
    {
        $data = $request->validate([
            'like' => 'required|integer|in:-1,0,1'
        ]);

        $userId = $request->user()->id;
        $likeValue = $data['like'];

        // On commence par récupérer les tableaux existants
        $usersLiked = $sauce->usersLiked;
        $usersDisliked = $sauce->usersDisliked;

        if ($likeValue === 1) {
            // L'utilisateur like la sauce
            if (!in_array($userId, $usersLiked)) {
                $usersLiked[] = $userId;
                $sauce->likes++;
            }
            // S'il avait disliké, on l'enlève
            if (($key = array_search($userId, $usersDisliked)) !== false) {
                unset($usersDisliked[$key]);
                $sauce->dislikes--;
            }
        } elseif ($likeValue === -1) {
            if (!in_array($userId, $usersDisliked)) {
                $usersDisliked[] = $userId;
                $sauce->dislikes++;
            }
            if (($key = array_search($userId, $usersLiked)) !== false) {
                unset($usersLiked[$key]);
                $sauce->likes--;
            }
        } else {
            // Annulation du vote
            if (($key = array_search($userId, $usersLiked)) !== false) {
                unset($usersLiked[$key]);
                $sauce->likes--;
            }
            if (($key = array_search($userId, $usersDisliked)) !== false) {
                unset($usersDisliked[$key]);
                $sauce->dislikes--;
            }
        }

        // Réassigner les tableaux mis à jour
        $sauce->usersLiked = array_values($usersLiked);
        $sauce->usersDisliked = array_values($usersDisliked);
        $sauce->save();

        return new SauceResource($sauce);
    }
}
