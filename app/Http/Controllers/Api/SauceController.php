<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sauce;
use App\Http\Resources\SauceResource;
use Illuminate\Http\Request;

class SauceController extends Controller
{
    public function index()
    {
        $sauces = Sauce::all();
        return SauceResource::collection($sauces);
    }

    public function show(Sauce $sauce)
    {
        return new SauceResource($sauce);
    }

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
        $sauce->mainPepper = $data['mainPepper'];
        $sauce->heat = $data['heat'];
        $sauce->imageUrl = $data['imageUrl'] ?? null;
        $sauce->user_id = $request->user()->id;
        $sauce->likes = 0;
        $sauce->dislikes = 0;
        $sauce->usersLiked = [];
        $sauce->usersDisliked = [];
        $sauce->save();

        return new SauceResource($sauce);
    }

    public function update(Request $request, Sauce $sauce)
    {
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

    public function destroy(Request $request, Sauce $sauce)
    {
        if ($sauce->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Action non autorisée'], 403);
        }

        $sauce->delete();
        return response()->json(['message' => 'Sauce supprimée !'], 200);
    }

    public function likeOrDislike(Request $request, Sauce $sauce)
    {
        $data = $request->validate([
            'like' => 'required|integer|in:-1,0,1'
        ]);

        $userId = $request->user()->id;
        $likeValue = $data['like'];

        $usersLiked = $sauce->usersLiked;
        $usersDisliked = $sauce->usersDisliked;

        if ($likeValue === 1) {
            if (!in_array($userId, $usersLiked)) {
                $usersLiked[] = $userId;
                $sauce->likes++;
            }
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
            if (($key = array_search($userId, $usersLiked)) !== false) {
                unset($usersLiked[$key]);
                $sauce->likes--;
            }
            if (($key = array_search($userId, $usersDisliked)) !== false) {
                unset($usersDisliked[$key]);
                $sauce->dislikes--;
            }
        }

        $sauce->usersLiked = array_values($usersLiked);
        $sauce->usersDisliked = array_values($usersDisliked);
        $sauce->save();

        return new SauceResource($sauce);
    }
}
