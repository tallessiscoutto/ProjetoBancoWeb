@extends('layouts.app')

@section('title', 'Consultar Funcionários')
@section('page-title', 'Funcionários')

@section('content')
<form method="GET" action="{{ route('Funcionarios.consultar') }}" class="mb-3">
    <div class="input-group">
        <input type="text" name="q" class="form-control" value="{{ $busca }}" placeholder="Nome, e-mail, documento ou cargo">
        <button class="btn btn-primary" type="submit"><i class="fas fa-search me-2"></i>Buscar</button>
    </div>
    <a class="btn btn-link" href="{{ route('Funcionarios.cadastro') }}">Cadastrar novo</a>
</form>

<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Documento</th>
                <th>E-mail</th>
                <th>Cargo</th>
                <th>Salário</th>
            </tr>
        </thead>
        <tbody>
            @forelse($funcionarios as $f)
            <tr>
                <td>{{ $f->id }}</td>
                <td>{{ $f->nome }}</td>
                <td>{{ $f->documento }}</td>
                <td>{{ $f->email }}</td>
                <td>{{ $f->cargo }}</td>
                <td>R$ {{ number_format($f->salario, 2, ',', '.') }}</td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center text-muted">Nenhum funcionário encontrado</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $funcionarios->links() }}
</div>
@endsection


