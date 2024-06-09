<?php

use App\Http\Controllers\AuthController;
//rota publico (listagem de produtos)
Route::get('/produto', [AuthController::class, 'index']);
//rotas protegidas (1.cadastro de produto[unico e multiplo];
// 3. edicao de produtos [unico e multiplo]; 2. exclusao de produtos[unico e multiplo]
Route::middleware('auth:api')->group(function () {
    Route::post('/produto', [AuthController::class, 'create']);
    Route::post('/produto/multiple', [AuthController::class, 'createMultiple']);
    Route::put('/produto/{produto}', [AuthController::class, 'update']);
    Route::put('/produto/multiple', [AuthController::class, 'updateMultiple']);
    Route::delete('/produto/{produto}', [AuthController::class, 'delete']);
    Route::delete('/produto/multiple', [AuthController::class, 'deleteMultiple']);
});

