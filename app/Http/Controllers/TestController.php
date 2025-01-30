<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Exception;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test(Request $request)
    {
        try {
            // Validation des données reçues
            $validatedData = $request->validate([
                'email' => 'required|email',
                'date' => 'required|date',
                'immatriculation' => 'required|string',
                'probleme' => 'required|string',
                'tel' => 'required|string',
            ]);

            // Création d'un nouvel enregistrement
            $post = new Test();
            $post->email = $validatedData['email'];
            $post->date = $validatedData['date'];
            $post->immatriculation = $validatedData['immatriculation'];
            $post->probleme = $validatedData['probleme'];
            $post->tel = $validatedData['tel'];
            $post->save();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Le post a été ajouté avec succès',
                'data' => $post
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status_code' => 500,
                'status_message' => 'Une erreur est survenue',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function read()
    {
        // Récupérer les interventions avec les colonnes spécifiées
        $post = test::all(['id', 'email', 'tel', 'immatriculation', 'date', 'probleme']);

        // Retourner les données sous forme de JSON
        return response()->json($post); // Retourne les données sous forme de JSON
    }

    // Controller Laravel pour supprimer une intervention
    public function delete($id)
    {
        $post = test::find($id);

        if ($post) {
            $post->delete();
            return response()->json(['message' => 'Intervention resolved successfully']);
        }

        return response()->json(['message' => 'Intervention not found'], 404);
    }

}

