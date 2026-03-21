<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Fornecedor;
use App\Models\Funcionario;



class RF_B04Controller extends Controller
{
    #PRODUTOS
    public function ExcluirProduto($id)
    {
        $produto = Produto::findOrFail($id);
        $produto->delete(); 
        return redirect()->route('Produtos.cadastro')->with('success', 'Produto excluído com sucesso!');
    }

    public function EditarProduto($id)
    {
        $produto = Produto::findOrFail($id);
        $categorias = Categoria::all();
        
        return view('Produtos.editar', compact('produto', 'categorias'));
    }
    #CLIENTES
    public function ExcluirCliente($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete(); 
        return redirect()->route('Clientes.cadastro')->with('success', 'Cliente excluído com sucesso!');
    }
    public function EditarCliente($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('Clientes.editar', compact('cliente'));
    }

    #FORNECEDORES
    public function ExcluirFornecedor($id)
    {
        $fornecedor = Fornecedor::findOrFail($id);
        $fornecedor->delete(); 
        return redirect()->route('Fornecedores.cadastro')->with('success', 'Fornecedor excluído com sucesso!');
    }
    public function EditarFornecedor($id)
    {
        $fornecedor = Fornecedor::findOrFail($id);
        return view('Fornecedores.editar', compact('fornecedor'));
    }
    #FUNCIONARIOS
    public function ExcluirFuncionario($id)
    {
        $funcionario = Funcionario::findOrFail($id);
        $funcionario->delete(); 
        return redirect()->route('Funcionarios.cadastro')->with('success', 'Funcionário excluído com sucesso!');
    }
    public function EditarFuncionario($id)
    {
        $funcionario = Funcionario::findOrFail($id);
        return view('Funcionarios.editar', compact('funcionario'));
    }
}