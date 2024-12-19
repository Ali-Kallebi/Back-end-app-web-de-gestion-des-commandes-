<?php
namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProduitController extends Controller
{
   

    public function index()
    {
        $produits = Produit::all();
        return response()->json($produits);
    }
    

    public function show($id)
    {
        $produit = Produit::findOrFail($id);
        return response()->json($produit);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'categorie' => 'required|string|max:255',
            'quantite' => 'required|numeric',
            'note' => 'nullable|integer',
            'statutInventaire' => 'required|string|max:255',
            'image' => 'nullable|string'  // Accept Base64 string
        ]);
    
        $produit = Produit::create($validatedData);
        return response()->json($produit, 201);
    }
    
    public function update(Request $request, $id)
    {
        $produit = Produit::findOrFail($id);
    
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'categorie' => 'required|string|max:255',
            'quantite' => 'required|numeric',
            'statutInventaire' => 'required|string|max:255',
            'image' => 'nullable|string'  // Accept Base64 string
        ]);
    
        $produit->update($validatedData);
    
        return response()->json($produit);
    }
    

    public function destroy($id)
    {
        $produit = Produit::findOrFail($id);
        $produit->delete();
        return response()->json(null, 204);
    }
}
