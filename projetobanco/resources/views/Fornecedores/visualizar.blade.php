@extends('layouts.app')

@section('title', 'Consultar Fornecedores')
@section('page-title', 'Fornecedores')

@section('content')
<form method="GET" action="{{ route('Fornecedores.consultar') }}" class="mb-3">
    <div class="input-group">
        <input type="text" name="q" class="form-control" value="{{ $busca }}" placeholder="Nome, e-mail ou documento">
        <button class="btn btn-primary" type="submit"><i class="fas fa-search me-2"></i>Buscar</button>
    </div>
    <a class="btn btn-link" href="{{ route('Fornecedores.cadastro') }}">Cadastrar novo</a>
</form>

<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Documento</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>Endereço</th>
            </tr>
        </thead>
        <tbody>
            @forelse($fornecedores as $f)
            <tr>
                <td>{{ $f->id }}</td>
                <td>{{ $f->nome }}</td>
                <td>{{ $f->documento }}</td>
                <td>{{ $f->email }}</td>
                <td>{{ $f->telefone }}</td>
                <td>{{ $f->endereco }}</td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center text-muted">Nenhum fornecedor encontrado</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $fornecedores->links() }}
</div>
@endsection


