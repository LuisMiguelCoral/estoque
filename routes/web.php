<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ProdutoBackupController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HistoricoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Aqui é onde você pode registrar as rotas da web para o seu aplicativo.
| Essas rotas são carregadas pelo RouteServiceProvider dentro de um grupo que
| contém o grupo de middleware "web". Agora crie algo incrível!
|
*/

// Rotas de autenticação
Auth::routes();

// Rota para a Home
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Rota resource para o controlador de produtos
Route::resource('produtos', ProdutoController::class);

// Rota para o método updateAll (atualização em massa)
Route::post('/produtos/update-all', [ProdutoController::class, 'updateAll'])->name('produtos.updateAll');

// Rota para o ProdutoBackupController
Route::get('/produto-backup', [ProdutoBackupController::class, 'index'])->name('produto-backup.index');

// Rota para o controlador de histórico
Route::get('/historico', [HistoricoController::class, 'index'])->name('historico.index');

Route::get('/produtos/edit/{id}', [ProdutoController::class, 'edit'])->name('produtos.edit');

Route::put('/historico/updateAll', [ProdutoController::class, 'updateHistoricos'])->name('historico.updateAll');
Route::get('/historico', [ProdutoController::class, 'historico'])->name('historico.index');
