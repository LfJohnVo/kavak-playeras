<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/camisetas/{type}', function (Request $request) {
    $result = DB::select("SELECT (id%2) as odd, id, nombre, numero FROM camisetas WHERE (id%2) = " . $request->type . " ORDER BY id LIMIT 0,1;");

    if (count($result) > 0) {
        DB::table('camisetas')->delete($result[0]->id);
        return json_encode(['estatus' => 200, 'id_eliminado' => $result[0]]);
    } else {
        return json_encode(['estatus' => 404]);
    }
});
