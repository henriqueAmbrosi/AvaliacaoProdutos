<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Product;
use App\ProductRating;

class ProductRatingController extends Controller
{
    public function index($product_id)
    {
        try {
            $product = Product::findOrFail($product_id);
            $ratings = $product->ratings()->get();

            return response()->json($ratings, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }
    }
    public function show($product_id, $id)
    {
        try {
            $rating = ProductRating::findOrFail($id);
            return response()->json($rating, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Avaliação não encontrada'], 404);
        }
    }
    public function create(Request $request, $product_id)
    {

        $rules = [
            "product_id" => 'required|exists:products,id',
            "name" => 'required',
            "grade" => 'required|numeric|min:0|max:5',
            "comment" => 'required',
        ];
        $messages = [
            'name.required' => 'O nome é obrigatório',
            'product_id.required' => 'Selecione um produto',
            'product_id.exists' => 'Selecione um produto válido',
            'grade.required' => 'A avaliação é obrigatória',
            'grade.numeric' => 'A avaliação é numérica',
            'grade.max' => 'A avaliação máxima é 5',
            'grade.min' => 'A avaliação mínima é 0',
            'comment.required' => 'O comentário é obrigatório',
        ];

        $this->validate($request, $rules, $messages);

        $rating = new ProductRating();

        $rating->product_id = $request->input('product_id');
        $rating->name = $request->input('name');
        $rating->grade = $request->input('grade');
        $rating->comment = $request->input('comment');

        $rating->save();

        return response()->json(['message' => 'Avaliação cadastrada com sucesso'], 201);
    }
    public function update(Request $request, $id)
    {
        $rules = [
            "product_id" => 'required|exists:products,id',
            "name" => 'required',
            "grade" => 'required|numeric|min:0|max:5',
            "comment" => 'required',
        ];
        $messages = [
            'name.required' => 'O nome é obrigatório',
            'product_id.required' => 'Selecione um produto',
            'product_id.exists' => 'Selecione um produto válido',
            'grade.required' => 'A avaliação é obrigatória',
            'grade.numeric' => 'A avaliação é numérica',
            'grade.max' => 'A avaliação máxima é 5',
            'grade.min' => 'A avaliação mínima é 0',
            'comment.required' => 'O comentário é obrigatório',
        ];

        $this->validate($request, $rules, $messages);
        try {
            $rating = ProductRating::findOrFail($id);

            $rating->product_id = $request->input('product_id');
            $rating->name = $request->input('name');
            $rating->grade = $request->input('grade');
            $rating->comment = $request->input('comment');

            $rating->save();

            return response()->json(['message' => 'Avaliação atualizada com sucesso'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Avaliação não encontrada'], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $rating = ProductRating::findOrFail($id);

            $rating->delete();


            return response()->json(['message' => 'Avaliação removida com sucesso'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Avaliação não encontrada'], 404);
        }
    }
}
