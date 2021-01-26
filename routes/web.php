<?php
use Illuminate\Support\Facades\Route;
//use Illuminate\Support\Facades\Auth;
use App\Models\Categoria;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/','IncioControler@index');
Route::get('tablero','IncioControler@tablero')->name('home');
Route::get('salir'        , 'AutenticarControler@salir');
Route::get('autenticar'        , 'AutenticarControler@autenticar');
Route::get('registrar'        , 'AutenticarControler@registrar');
Route::post('agregar'        , 'AutenticarControler@agregar');
Route::post('validar'        , 'AutenticarControler@validar');
Route::get('listar_por_categoria/{categoria_id}','ExploracionControler@listar_por');
Route::post('busqueda','ExploracionControler@busqueda');
Route::get('Categorias','CategoriasControler@index');
Route::post('Categorias','CategoriasControler@store');
Route::get('Categorias/create','CategoriasControler@create');
Route::get('Categorias/{categoria}','CategoriasControler@show');
Route::put('Categorias/{categoria}','CategoriasControler@update');
Route::delete('Categorias/{categoria}','CategoriasControler@destroy');
Route::get('Categorias/{categoria}/edit','CategoriasControler@edit');
Route::resource('Usuarios','UsuariosControler');
Route::resource('Productos','ProductosControler');
Route::resource('Revisiones', 'RevisarControler', [
    'only' => ['index', 'show', 'update']
]);
Route::delete('/productos/delete','ProductosControler@deletePhoto')->name('delete.photo');
Route::resource('Preguntas', 'PreguntasControler', [
    'except' => [ 'create' ]
]);
Route::get('Preguntar/{producto}','PreguntasControler@create');

//  rutas para llamar por ajax
Route::put('_Usuarios/{id}','AjaxControler@updateUsuario');
Route::post('_Categorias','AjaxControler@storeCategoria');
Route::delete('_Categorias/{id}','AjaxControler@destroyCategoria');

//ventas
Route::get('/venta/nueva','VentaController@index')->name('nuevaVenta');    
Route::post('/venta/create','VentaController@create')->name('venta.create');    
//pagos 
Route::get('/pago/nuevo','PagoController@index')->name('nuevoPago');
Route::get('/pago/pagar/{id}','PagoController@pagar')->name('pagar');
Route::post('/pago/pagar/finalizar','PagoController@createPago')->name('createPago');