<?php

use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\VendedorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/vendedor', [VendedorController::class, 'listar']); //Rota , nome da minha classe, nome do método
Route::post('/vendedor', [VendedorController::class, 'salvar']); //Rota , nome da minha classe, nome do método
Route::put('/vendedor/{id}', [VendedorController::class, 'editar']); //Rota , {id banco de dados}, nome da minha classe, nome do método
Route::delete('/vendedor/{id}', [VendedorController::class, 'excluir']); //Rota , {id banco de dados} ,nome da minha classe, nome do método
Route::get('/vendedor/{id}',[VendedorController::class, 'listarPeloId']);

Route::get('/produto', [ProdutoController::class, 'listar']); //Rota , nome da minha classe, nome do método
Route::post('/produto', [ProdutoController::class, 'salvar']); //Rota , nome da minha classe, nome do método
Route::put('/produto/{id}', [ProdutoController::class, 'editar']); //Rota , {id banco de dados}, nome da minha classe, nome do método
Route::delete('/produto/{id}', [ProdutoController::class, 'excluir']); //Rota , {id banco de dados} ,nome da minha classe, nome do método
Route::get('/produto/{id}',[ProdutoController::class, 'listarPeloId']);