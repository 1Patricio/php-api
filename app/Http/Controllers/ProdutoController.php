<?php

namespace App\Http\Controllers;    // Caminho da pasta

use App\Models\Produto;
use App\Responses\ApiResponse;
use Illuminate\Http\Request;       // Vai substituir o require_once 
use Illuminate\Support\Facades\Validator;

class ProdutoController extends Controller  //ok
{
    public function salvar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:200',
            'preco' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $customer = Produto::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Produto criado com sucesso',
            'data' => $customer
        ], 201);
    }

    public function listar()  //ok
    {
        $customers = Produto::all();
        return response()->json([
            'status' => true,
            'message' => 'Customers retrieved successfully',
            'data' => $customers
        ], 200);
    }

    public function listarPeloId(int $id)  //ok
    {
        $customer = Produto::findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'Customer found successfully',
            'data' => $customer
        ], 200);
    }
    
    public function editar(Request $request, int $id) //ok
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:200',
            'preco' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $customer = Produto::findOrFail($id);
        $customer->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Produto updated successfully',
            'data' => $customer
        ], 200);
    }
    public function excluir( int $id)  //OK
    {
        $customer = Produto::findOrFail($id);
        $customer->delete();
        
        return response()->json([
            'status' => true,
            'message' => 'Customer deleted successfully'
        ], 204);
    }
}
