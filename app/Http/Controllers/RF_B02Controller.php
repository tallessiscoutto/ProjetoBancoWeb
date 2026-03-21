<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Fornecedor;

class RF_B02Controller extends Controller
{   #Clientes
    public function CadastrarCliente(){
        $clientes = Cliente::all();
        return view('Clientes.cadastro', compact('clientes'));
    }
    public function ConsultarClientes(Request $request){
        $busca = $request->input('q');
        $query = Cliente::query();
        if ($busca) {
            $query->where(function($q) use ($busca) {
                $q->where('nome', 'like', "%{$busca}%")
                  ->orWhere('email', 'like', "%{$busca}%")
                  ->orWhere('documento', 'like', "%{$busca}%");
            });
        }
        $clientes = $query->orderBy('nome')->paginate(10)->withQueryString();
        return view('Clientes.visualizar', compact('clientes', 'busca'));
    }
    public function SalvarCliente(Request $request){
        // Limpa as máscaras antes da validação
        $documento = preg_replace('/[^0-9]/', '', $request->documento);
        $telefone = preg_replace('/[^0-9]/', '', $request->telefone);

        $request->merge([
            'documento' => $documento,
            'telefone' => $telefone
        ]);

        $request->validate([
            'nome' => 'required|string|max:80',
            'documento' => ['required', 'regex:/^(\d{11}|\d{14})$/'],
            'email' => 'required|email|unique:clientes',
            'telefone' => 'required|regex:/^[0-9]{10,11}$/',
            'endereco' => 'required|string|max:100'
        ], [
            'documento.regex' => 'O CPF deve ter 11 dígitos ou CNPJ deve ter 14 dígitos.',
            'telefone.regex' => 'O telefone deve ter entre 10 e 11 dígitos.'
        ]);
    
        $cliente = Cliente::create([
            'nome' => $request->nome,
            'documento' => $documento,
            'email' => $request->email,
            'telefone' => $telefone,
            'endereco' => $request->endereco
        ]);

        return redirect()->route('Clientes.cadastro')->with('success', 'Cliente cadastrado com sucesso!');
    }
    public function AtualizarCliente(Request $request, $id){
        // Limpa as máscaras antes da validação
        $documento = preg_replace('/[^0-9]/', '', $request->documento);
        $telefone = preg_replace('/[^0-9]/', '', $request->telefone);

        $request->merge([
            'documento' => $documento,
            'telefone' => $telefone
        ]);

        $request->validate([
            'nome' => 'required|string|max:80',
            'documento' => ['required', 'regex:/^(\d{11}|\d{14})$/', 'unique:clientes,documento,'.$id],
            'email' => 'required|email|unique:clientes,email,'.$id,
            'telefone' => 'required|regex:/^[0-9]{10,11}$/',
            'endereco' => 'required|string|max:100'
        ], [
            'documento.regex' => 'O CPF deve ter 11 dígitos ou CNPJ deve ter 14 dígitos.',
            'telefone.regex' => 'O telefone deve ter entre 10 e 11 dígitos.'
        ]);

        $cliente = Cliente::findOrFail($id);
        $cliente->update([
            'nome' => $request->nome,
            'documento' => $documento,
            'email' => $request->email,
            'telefone' => $telefone,
            'endereco' => $request->endereco
        ]);

        return redirect()->route('Clientes.cadastro')->with('success', 'Cliente atualizado com sucesso!');
    }
    public function ListarCliente(){
        $Clientes = Cliente::all();
        var_dump($Clientes);
        return view('Cliente.cadastro', ['Cliente' => $Clientes]);
    }


    #Fornecedores
    public function CadastrarFornecedor(){
        $fornecedores = Fornecedor::all();
        return view('Fornecedores.cadastro', compact('fornecedores'));
    }
    public function ConsultarFornecedores(Request $request){
        $busca = $request->input('q');
        $query = Fornecedor::query();
        if ($busca) {
            $query->where(function($q) use ($busca) {
                $q->where('nome', 'like', "%{$busca}%")
                  ->orWhere('email', 'like', "%{$busca}%")
                  ->orWhere('documento', 'like', "%{$busca}%");
            });
        }
        $fornecedores = $query->orderBy('nome')->paginate(10)->withQueryString();
        return view('Fornecedores.visualizar', compact('fornecedores', 'busca'));
    }
    public function SalvarFornecedor(Request $request){
        // Limpa as máscaras antes da validação
        $documento = preg_replace('/[^0-9]/', '', $request->documento);
        $telefone = preg_replace('/[^0-9]/', '', $request->telefone);

        $request->merge([
            'documento' => $documento,
            'telefone' => $telefone
        ]);

        $request->validate([
            'nome' => 'required|string|max:80',
            'documento' => ['required', 'regex:/^(\d{11}|\d{14})$/', 'unique:fornecedores'],
            'endereco' => 'required|string|max:100',
            'produtos_disponiveis' => 'required',
            'formas_pagamento' => 'required',
            'telefone' => 'required|regex:/^[0-9]{10,11}$/',
            'email' => 'required|email|unique:fornecedores'
        ], [
            'documento.regex' => 'O CPF deve ter 11 dígitos ou CNPJ deve ter 14 dígitos.',
            'telefone.regex' => 'O telefone deve ter entre 10 e 11 dígitos.'
        ]);
    
        $fornecedor = Fornecedor::create([
            'nome' => $request->nome,
            'documento' => $documento,
            'endereco' => $request->endereco,
            'produtos_disponiveis' => $request->produtos_disponiveis,
            'formas_pagamento' => $request->formas_pagamento,
            'telefone' => $telefone,
            'email' => $request->email
        ]);

        return redirect()->route('Fornecedores.cadastro')->with('success', 'Fornecedor cadastrado com sucesso!');
    }
    public function ListarFornecedor(){
        $fornecedores = Fornecedor::all();
        return view('Fornecedores.cadastro', compact('fornecedores'));
    }
    public function AtualizarFornecedor(Request $request, $id){
        // Limpa as máscaras antes da validação
        $documento = preg_replace('/[^0-9]/', '', $request->documento);
        $telefone = preg_replace('/[^0-9]/', '', $request->telefone);

        $request->merge([
            'documento' => $documento,
            'telefone' => $telefone
        ]);

        $request->validate([
            'nome' => 'required|string|max:80',
            'documento' => ['required', 'regex:/^(\d{11}|\d{14})$/', 'unique:fornecedores,documento,'.$id],
            'endereco' => 'required|string|max:100',
            'produtos_disponiveis' => 'required',
            'formas_pagamento' => 'required',
            'telefone' => 'required|regex:/^[0-9]{10,11}$/',
            'email' => 'required|email|unique:fornecedores,email,'.$id
        ], [
            'documento.regex' => 'O CPF deve ter 11 dígitos ou CNPJ deve ter 14 dígitos.',
            'telefone.regex' => 'O telefone deve ter entre 10 e 11 dígitos.'
        ]);

        $fornecedor = Fornecedor::findOrFail($id);
        $fornecedor->update([
            'nome' => $request->nome,
            'documento' => $documento,
            'endereco' => $request->endereco,
            'produtos_disponiveis' => $request->produtos_disponiveis,
            'formas_pagamento' => $request->formas_pagamento,
            'telefone' => $telefone,
            'email' => $request->email
        ]);

        return redirect()->route('Fornecedores.cadastro')->with('success', 'Fornecedor atualizado com sucesso!');
    }
}