<?php

namespace App\Http\Controllers;    // Caminho da pasta

use App\Models\Vendedor;
use App\Responses\ApiResponse;
use Illuminate\Http\Request;       // Vai substituir o require_once 
use Illuminate\Support\Facades\Validator;

class VendedorController extends Controller
{
    public function salvar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:200',
            'cpf' => 'string|max:15',
            'ano_nascimento' => 'integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $customer = Vendedor::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Customer created successfully',
            'data' => $customer
        ], 201);
    }

    public function listar()
    {
        $customers = Vendedor::all();
        return response()->json([
            'status' => true,
            'message' => 'Customers retrieved successfully',
            'data' => $customers
        ], 200);
    }

    public function listarPeloId(int $id)
    {
        $customer = Vendedor::findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'Customer found successfully',
            'data' => $customer
        ], 200);
    }
    
    public function editar(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:200',
            'cpf' => 'string|max:15',
            'ano_nascimento' => 'integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $customer = Vendedor::findOrFail($id);
        $customer->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Produto updated successfully',
            'data' => $customer
        ], 200);
    }
    public function excluir( int $id)
    {
        $customer = Vendedor::findOrFail($id);
        $customer->delete();
        
        return response()->json([
            'status' => true,
            'message' => 'Customer deleted successfully'
        ], 204);
    }
}
