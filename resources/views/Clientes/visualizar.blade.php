@extends('layouts.app')

@section('title', 'Consultar Clientes')
@section('page-title', 'Clientes')

@section('content')
<form method="GET" action="{{ route('Clientes.consultar') }}" class="mb-3">
    <div class="input-group">
        <input type="text" name="q" class="form-control" value="{{ $busca }}" placeholder="Nome, e-mail ou documento">
        <button class="btn btn-primary" type="submit"><i class="fas fa-search me-2"></i>Buscar</button>
    </div>
    <a class="btn btn-link" href="{{ route('Clientes.cadastro') }}">Cadastrar novo</a>
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
            @forelse($clientes as $c)
            <tr>
                <td>{{ $c->id }}</td>
                <td>{{ $c->nome }}</td>
                <td>{{ $c->documento }}</td>
                <td>{{ $c->email }}</td>
                <td>{{ $c->telefone }}</td>
                <td>{{ $c->endereco }}</td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center text-muted">Nenhum cliente encontrado</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

{{ $clientes->links() }}
@endsection


