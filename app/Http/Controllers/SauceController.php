<?php

namespace App\Http\Controllers;

use App\Models\Sauce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SauceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sauces = Sauce::all();
        return view('sauces.index', compact('sauces'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sauces.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $sauce = new Sauce();
        $sauce->name = $request->input('name');
        $sauce->manufacturer = $request->input('manufacturer');
        $sauce->description = $request->input('description');
        $sauce->mainPepper = $request->input('mainPepper');
        $sauce->imageUrl = $request->input('imageUrl');
        $sauce->heat = $request->input('heat');
        $sauce->likes = 0;
        $sauce->dislikes = 0;
        $sauce->usersLiked = [];
        $sauce->usersDisliked = [];

        if (Auth::check()) {
            $sauce->user_id = Auth::id();
        } else {
            $sauce->user_id = 1;
        }

        $sauce->save();

        return redirect()->route('sauces.index')->with('success', 'Sauce ajoutée avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sauce = Sauce::findOrFail($id);
        return view('sauces.show', compact('sauce'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sauce = Sauce::findOrFail($id);
        return view('sauces.edit', compact('sauce'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sauce = Sauce::findOrFail($id);

        $sauce->name = $request->input('name');
        $sauce->manufacturer = $request->input('manufacturer');
        $sauce->description = $request->input('description');
        $sauce->mainPepper = $request->input('mainPepper');
        $sauce->imageUrl = $request->input('imageUrl');
        $sauce->heat = $request->input('heat');
        
        $sauce->save();

        return redirect()->route('sauces.show', $sauce->id)->with('success', 'Sauce mise à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sauce = Sauce::findOrFail($id);
        $sauce->delete();
        return redirect()->route('sauces.index')->with('success', 'Sauce supprimée.');
    }

    /**
     *  Gérer le like ou dislike sur une sauce
     */
    public function like(Request $request, $id)
    {
        $sauce = Sauce::findOrFail($id);
        $userId = Auth::check() ? Auth::id() : $request->input('user_id');
        $likeValue = $request->input('like');

        if ($likeValue == 1) {
            // Cas où l'utilisateur aime la sauce (like)
            if (!in_array($userId, $sauce->usersLiked)) {
                // Si l'utilisateur n'a pas déjà liké cette sauce, on l'ajoute
                $newUsersLiked = $sauce->usersLiked;
                $newUsersLiked[] = $userId;
                $sauce->usersLiked = $newUsersLiked;
                $sauce->likes++;
                // S'il avait disliké auparavant, on retire son dislike
                if (in_array($userId, $sauce->usersDisliked)) {
                    $newUsersDisliked = array_diff($sauce->usersDisliked, [$userId]);
                    $sauce->usersDisliked = array_values($newUsersDisliked);
                    $sauce->dislikes--;
                }
            }
        } elseif ($likeValue == -1) {
            // Cas où l'utilisateur n'aime pas la sauce (dislike)
            if (!in_array($userId, $sauce->usersDisliked)) {
                // S'il n'a pas déjà disliké, on l'ajoute
                $newUsersDisliked = $sauce->usersDisliked;
                $newUsersDisliked[] = $userId;
                $sauce->usersDisliked = $newUsersDisliked;
                $sauce->dislikes++;
                // S'il avait liké auparavant, on retire son like
                if (in_array($userId, $sauce->usersLiked)) {
                    $newUsersLiked = array_diff($sauce->usersLiked, [$userId]);
                    $sauce->usersLiked = array_values($newUsersLiked);
                    $sauce->likes--;
                }
            }
        } elseif ($likeValue == 0) {
            // Cas où l'utilisateur annule son vote (ni like ni dislike)
            if (in_array($userId, $sauce->usersLiked)) {
                // S'il avait liké, on l'enlève de la liste des likes
                $newUsersLiked = array_diff($sauce->usersLiked, [$userId]);
                $sauce->usersLiked = array_values($newUsersLiked);
                $sauce->likes--;
            }
            if (in_array($userId, $sauce->usersDisliked)) {
                // S'il avait disliké, on l'enlève de la liste des dislikes
                $newUsersDisliked = array_diff($sauce->usersDisliked, [$userId]);
                $sauce->usersDisliked = array_values($newUsersDisliked);
                $sauce->dislikes--;
            }
        }

        $sauce->save();
        return redirect()->route('sauces.show', $id)->with('success', 'Préférence enregistrée !');
    }
}
