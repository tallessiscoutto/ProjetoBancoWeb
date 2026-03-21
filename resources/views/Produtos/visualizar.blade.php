@extends('layouts.app')

@section('title', 'Visualizar Produtos')

@section('page-title', 'Produtos')
@section('page-description', 'Consulte e filtre produtos do catálogo')

@section('content')
<form method="GET" action="{{ route('Produtos.visualizar') }}" class="mb-3">
    <div class="input-group">
        <input type="text" class="form-control" name="q" value="{{ $busca }}" placeholder="Buscar por nome, descrição ou código">
        <button class="btn btn-primary" type="submit"><i class="fas fa-search me-2"></i>Buscar</button>
    </div>
    @if($busca)
        <small class="text-muted">Mostrando resultados para: <strong>{{ $busca }}</strong></small>
    @endif
    <a class="btn btn-link" href="{{ route('Produtos.cadastro') }}">Cadastrar novo</a>
</form>

<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Código</th>
                <th>Foto</th>
                <th>Marca</th>
                <th>Nome</th>
                <th>Fornecedor</th>
                <th>Preço</th>
                <th>Estoque</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($produtos as $p)
            <tr>
                <td>#{{ $p->id }}</td>
                <td>
                    @if($p->foto)
                        <img src="{{ asset('storage/'.$p->foto) }}" alt="{{ $p->nome }}" style="width:40px;height:40px;object-fit:cover;border-radius:6px;">
                    @else
                        <span class="text-muted">—</span>
                    @endif
                </td>
                <td>{{ $p->marca ?? '—' }}</td>
                <td>{{ $p->nome }}</td>
                <td>{{ optional($p->fornecedor)->nome }}</td>
                <td>R$ {{ number_format($p->preco, 2, ',', '.') }}</td>
                <td>{{ $p->quantidade }}</td>
                <td class="text-end">
                    <a class="btn btn-sm btn-primary" href="{{ route('Produtos.editar', $p->id) }}"><i class="fas fa-edit"></i></a>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" class="text-center text-muted">Nenhum produto encontrado</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

{{ $produtos->links() }}
@endsection


