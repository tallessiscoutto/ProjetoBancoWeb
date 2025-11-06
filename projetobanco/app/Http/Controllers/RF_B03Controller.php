<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Funcionario;

class RF_B03Controller extends Controller
{
    public function CadastrarFuncionario()
    {
        $funcionarios = Funcionario::all();
        return view('Funcionarios.cadastro', compact('funcionarios'));
    }

    public function SalvarFuncionario(Request $request)
    {
        // Limpa a máscara do documento
        $documento = preg_replace('/[^0-9]/', '', $request->documento);
        
        // Converte o salário para formato correto
        $salario = str_replace(['R$', ' ', '.'], '', $request->salario);
        $salario = str_replace(',', '.', $salario);
        
        $request->merge([
            'documento' => $documento,
            'salario' => $salario
        ]);

        $request->validate([
            'nome' => 'required|string|max:100',
            'documento' => ['required', 'regex:/^(\d{11}|\d{14})$/', 'unique:funcionarios'],
            'salario' => 'required|numeric|min:0|decimal:0,2',
            'cargo' => 'required|string|min:3|max:50',
            'email' => 'required|email|unique:funcionarios'
        ], [
            'documento.regex' => 'O CPF deve ter 11 dígitos ou CNPJ deve ter 14 dígitos.',
            'salario.decimal' => 'O salário deve ter no máximo 2 casas decimais.',
            'salario.min' => 'O salário não pode ser negativo.'
        ]);

        $funcionario = Funcionario::create([
            'nome' => $request->nome,
            'documento' => $documento,
            'salario' => $salario,
            'cargo' => $request->cargo,
            'email' => $request->email
        ]);

        return redirect()->route('Funcionarios.cadastro')->with('success', 'Funcionário cadastrado com sucesso!');
    }

    public function ConsultarFuncionarios(Request $request)
    {
        $busca = $request->input('q');
        $query = Funcionario::query();
        if ($busca) {
            $query->where(function($q) use ($busca) {
                $q->where('nome', 'like', "%{$busca}%")
                  ->orWhere('email', 'like', "%{$busca}%")
                  ->orWhere('documento', 'like', "%{$busca}%")
                  ->orWhere('cargo', 'like', "%{$busca}%");
            });
        }
        $funcionarios = $query->orderBy('nome')->paginate(10)->withQueryString();
        return view('Funcionarios.visualizar', compact('funcionarios', 'busca'));
    }

    public function ListarFuncionario()
    {
        $funcionarios = Funcionario::all();
        return view('Funcionarios.cadastro', compact('funcionarios'));
    }

    public function AtualizarFuncionario(Request $request, $id)
    {
        // Limpa a máscara do documento
        $documento = preg_replace('/[^0-9]/', '', $request->documento);
        
        // Converte o salário para formato correto
        $salario = str_replace(['R$', ' ', '.'], '', $request->salario);
        $salario = str_replace(',', '.', $salario);
        
        $request->merge([
            'documento' => $documento,
            'salario' => $salario
        ]);

        $request->validate([
            'nome' => 'required|string|max:100',
            'documento' => ['required', 'regex:/^(\d{11}|\d{14})$/', 'unique:funcionarios,documento,'.$id],
            'salario' => 'required|numeric|min:0|decimal:0,2',
            'cargo' => 'required|string|min:3|max:50',
            'email' => 'required|email|unique:funcionarios,email,'.$id
        ], [
            'documento.regex' => 'O CPF deve ter 11 dígitos ou CNPJ deve ter 14 dígitos.',
            'salario.decimal' => 'O salário deve ter no máximo 2 casas decimais.',
            'salario.min' => 'O salário não pode ser negativo.'
        ]);

        $funcionario = Funcionario::findOrFail($id);
        $funcionario->update([
            'nome' => $request->nome,
            'documento' => $documento,
            'salario' => $salario,
            'cargo' => $request->cargo,
            'email' => $request->email
        ]);

        return redirect()->route('Funcionarios.cadastro')->with('success', 'Funcionário atualizado com sucesso!');
    }
}
