<?php

use Illuminate\Http\Request;
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


Route::post('login', 'AuthController@login');
Route::middleware('jwt.verify:api')->post('logout', 'AuthController@logout');
Route::middleware('jwt.verify:api')->post('refresh', 'AuthController@refresh');
Route::middleware('jwt.verify:api')->post('me', 'AuthController@me');
Route::middleware('jwt.verify:api')->post('perfil', 'AuthController@perfil');
Route::middleware('jwt.verify:api')->Resource('menu', 'MenuController');
Route::middleware('jwt.verify:api')->Resource('usuario', 'UsuarioController');
Route::middleware('jwt.verify:api')->Resource('area', 'AreaController');

Route::middleware('jwt.verify:api')->get('listamaterias/{id}', 'CategoriaController@listaMaterias');
Route::get('setor/getbyempresa/{id}', 'SetorController@getByEmpresa');
Route::middleware('jwt.verify:api')->Resource('setor', 'SetorController');

Route::middleware('jwt.verify:api')->Resource('categoria', 'CategoriaController');


Route::middleware('jwt.verify:api')->get('cargo/getbyempresa/{id}', 'CargoController@getByEmpresa');
Route::middleware('jwt.verify:api')->Resource('cargo', 'CargoController');

Route::middleware('jwt.verify:api')->Resource('empresa', 'EmpresaController');
Route::middleware('jwt.verify:api')->Resource('conteudo', 'ConteudoController');
Route::middleware('jwt.verify:api')->Resource('alertas', 'AlertasController');
Route::middleware('jwt.verify:api')->Resource('fale-conosco', 'FaleConoscoController');
Route::middleware('jwt.verify:api')->Resource('gestor', 'GestorController');
Route::middleware('jwt.verify:api')->Resource('questionario', 'QuestionarioController');
Route::middleware('jwt.verify:api')->get('resposta/getbyquestao/{id}', 'RespostasController@getByQuestao');
Route::middleware('jwt.verify:api')->Resource('resposta', 'RespostasController');

Route::middleware('jwt.verify:api')->Resource('materia', 'MateriaController');
Route::middleware('jwt.verify:api')->get('questao/getbyquestionario/{id}', 'QuestaoController@getByQuestionario');
Route::middleware('jwt.verify:api')->Resource('questao', 'QuestaoController');
Route::middleware('jwt.verify:api')->post('item/createQuestionario', 'ItemController@createQuestionario');
Route::middleware('jwt.verify:api')->Resource('item', 'ItemController');
Route::middleware('jwt.verify:api')->get('item/getbymateria/{id}', 'ItemController@getByMateria');
Route::middleware('jwt.verify:api')->get('resposta/getbyquestionario/{id}', 'RespostasController@getByQuestionario');

Route::middleware('jwt.verify:api')->get('favorito/getbyfavorito/{pkMateria}', 'FavoritoController@show');
Route::middleware('jwt.verify:api')->Resource('favorito', 'FavoritoController');

Route::get('ferias/getbyferias/', 'FeriasController@getByFerias');
Route::Resource('ferias', 'FeriasController');

Route::Resource('status', 'StatusController');

Route::middleware('jwt.verify:api')->get('/cep/{id}', 'CepController@index');









