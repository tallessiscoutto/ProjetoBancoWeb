<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RF_B01Controller;
use App\Http\Controllers\RF_B02Controller;
use App\Http\Controllers\RF_B03Controller;
use App\Http\Controllers\RF_B04Controller;
use App\Http\Controllers\RF_F01Controller;
use App\Http\Controllers\RF_F02Controller;
use App\Http\Controllers\RF_S01Controller;
use App\Http\Controllers\RF_R01Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

// Rotas públicas
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Rotas protegidas
Route::middleware(['auth'])->group(function () {
    // Rota inicial após login (dashboard)
    Route::get('/', [HomeController::class, 'index'])->name('home');
    
    Route::get('/home', [HomeController::class, 'index']);

    // Rotas de Produtos
    Route::get('/Produtos/cadastro', [ProdutosController::class, 'index'])->name('Produtos.cadastro');
    Route::get('/Produtos/visualizar', [ProdutosController::class, 'visualizar'])->name('Produtos.visualizar');
    Route::get('/Produtos/show/{id}', [ProdutosController::class, 'show'])->name('Produtos.show');
    Route::post('/Produtos/salvar', [ProdutosController::class, 'store'])->name('Produtos.salvar');
    Route::get('/Produtos/editar/{id}', [ProdutosController::class, 'edit'])->name('Produtos.editar');
    Route::put('/Produtos/atualizar/{id}', [ProdutosController::class, 'update'])->name('Produtos.atualizar');
    Route::get('/locacao', [ProdutoController::class, 'busca'])->name('locacao.busca');   // routes/web.php
    Route::get('/Localizacao', [ProdutosController::class, 'cadastrarLocalizacao'])->name('Localizacao.index');
    Route::delete('/Produtos/excluir/{id}', [ProdutosController::class, 'destroy'])->name('Produtos.excluir');

    // Rotas de Clientes
    Route::get('/Clientes/cadastro',[RF_B02Controller::class,'CadastrarCliente'])->name('Clientes.cadastro');
    Route::get('/Clientes/consultar',[RF_B02Controller::class,'ConsultarClientes'])->name('Clientes.consultar');
    Route::post('/Clientes/salvar',[RF_B02Controller::class,'SalvarCliente'])->name('Clientes.Salvar');
    Route::get('/Clientes/editar/{id}', [RF_B04Controller::class, 'EditarCliente'])->name('Clientes.editar');
    Route::put('/Clientes/atualizar/{id}', [RF_B02Controller::class, 'AtualizarCliente'])->name('Clientes.atualizar');
    Route::delete('/Clientes/excluir/{id}', [RF_B04Controller::class, 'ExcluirCliente'])->name('Clientes.excluir');

    // Rotas de Fornecedores
    Route::get('/Fornecedores/cadastro', [RF_B02Controller::class, 'CadastrarFornecedor'])->name('Fornecedores.cadastro');
    Route::get('/Fornecedores/consultar', [RF_B02Controller::class, 'ConsultarFornecedores'])->name('Fornecedores.consultar');
    Route::post('/Fornecedores/salvar', [RF_B02Controller::class, 'SalvarFornecedor'])->name('Fornecedores.salvar');
    Route::get('/Fornecedores/editar/{id}', [RF_B04Controller::class, 'EditarFornecedor'])->name('Fornecedores.editar');
    Route::put('/Fornecedores/atualizar/{id}', [RF_B02Controller::class, 'AtualizarFornecedor'])->name('Fornecedores.atualizar');
    Route::delete('/Fornecedores/excluir/{id}', [RF_B04Controller::class, 'ExcluirFornecedor'])->name('Fornecedores.excluir');

    // Rotas de Funcionários
    Route::get('/Funcionarios/cadastro', [RF_B03Controller::class, 'CadastrarFuncionario'])->name('Funcionarios.cadastro');
    Route::get('/Funcionarios/consultar', [RF_B03Controller::class, 'ConsultarFuncionarios'])->name('Funcionarios.consultar');
    Route::post('/Funcionarios/salvar', [RF_B03Controller::class, 'SalvarFuncionario'])->name('Funcionarios.salvar');
    Route::get('/Funcionarios/editar/{id}', [RF_B04Controller::class, 'EditarFuncionario'])->name('Funcionarios.editar');
    Route::put('/Funcionarios/atualizar/{id}', [RF_B03Controller::class, 'AtualizarFuncionario'])->name('Funcionarios.atualizar');
    Route::delete('/Funcionarios/excluir/{id}', [RF_B04Controller::class, 'ExcluirFuncionario'])->name('Funcionarios.excluir');

    // Rotas de Compras
    Route::get('/Compras/cadastro', [RF_F01Controller::class, 'cadastrarCompra'])->name('Compras.cadastro');
    Route::post('/Compras/salvar', [RF_F01Controller::class, 'salvarCompra'])->name('Compras.salvar');
    Route::get('/Compras/{id}/editar', [RF_F01Controller::class, 'editarCompra'])->name('Compras.editar');
    Route::put('/Compras/{id}/atualizar', [RF_F01Controller::class, 'atualizarCompra'])->name('Compras.atualizar');
    Route::delete('/Compras/{id}/excluir', [RF_F01Controller::class, 'excluirCompra'])->name('Compras.excluir');

    // Rotas de Vendas
    Route::match(['get', 'post'], '/Vendas/cadastro', [RF_F02Controller::class, 'cadastrarVenda'])->name('Vendas.cadastro');
    Route::post('/Vendas/buscar-produto', [RF_F02Controller::class, 'buscarProduto'])->name('Vendas.buscar');
    Route::post('/Vendas/buscar-cliente', [RF_F02Controller::class, 'buscarCliente'])->name('Vendas.buscarCliente');
    Route::post('/Vendas/salvar', [RF_F02Controller::class, 'salvarVenda'])->name('Vendas.salvar');

    // Rotas de Relatórios
    Route::get('/Relatorios/Vendas', [RF_S01Controller::class, 'relatorioVendas'])->name('Relatorios.vendas');
    Route::get('/Relatorios/Vendas/PDF', [RF_S01Controller::class, 'gerarPDF'])->name('Relatorios.vendas.pdf');
    Route::get('/Relatorios/Vendas/Excel', [RF_S01Controller::class, 'exportarExcel'])->name('Relatorios.vendas.excel');

    // Rotas de Reservas
    Route::get('/Reservas/cadastro', [RF_R01Controller::class, 'cadastrarReserva'])->name('Reservas.cadastro');
    Route::post('/Reservas/salvar', [RF_R01Controller::class, 'salvarReserva'])->name('Reservas.salvar');
    Route::post('/Reservas/{id}/concluir', [RF_R01Controller::class, 'concluirReserva'])->name('Reservas.concluir');
    Route::post('/Reservas/{id}/cancelar', [RF_R01Controller::class, 'cancelarReserva'])->name('Reservas.cancelar');

});

// Rota de logout (pode ficar fora do grupo auth pois já requer autenticação)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');