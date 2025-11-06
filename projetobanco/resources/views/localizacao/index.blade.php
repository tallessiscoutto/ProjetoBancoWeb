@extends('layouts.financeiro')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center fw-bold text-primary">📦 Localização de Produtos no Estoque</h2>

    <form action="{{ route('Localizacao.index') }}" method="GET" class="d-flex justify-content-center mb-4">
        <input type="text" name="busca" 
               class="form-control w-50 me-2 shadow-sm" 
               placeholder="🔍 Buscar por nome ou ID" 
               value="{{ old('busca', $busca ?? '') }}">
        <button type="submit" class="btn btn-primary px-4">Buscar</button>
    </form>

    @if(isset($produtos) && $produtos->count() > 0)
        <div class="table-responsive shadow-sm rounded-3">
            <table class="table table-striped table-hover align-middle text-center">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Localização</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($produtos as $produto)
                        <tr @if(isset($busca) && (stripos($produto->nome, $busca) !== false || $produto->id == $busca)) 
                                class="table-info fw-bold" 
                            @endif>
                            <td>{{ $produto->id }}</td>
                            <td>{{ $produto->nome }}</td>
                            <td>{{ $produto->localizacao ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-3 d-flex justify-content-center">
            {{ $produtos->links() }}
        </div>
    @elseif(isset($busca))
        <div class="alert alert-warning text-center shadow-sm">
            Nenhum produto encontrado para "<strong>{{ $busca }}</strong>".
        </div>
    @endif
</div>

<style>
    /* Estilos adicionais para refinar */
    body {
        background-color: #f8f9fa;
    }

    .table {
        border-radius: 0.75rem;
        overflow: hidden;
    }

    .table thead th {
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .table tbody tr:hover {
        background-color: #e9f3ff !important;
        transition: 0.2s;
    }

    input.form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(13,110,253,0.25);
        border-color: #86b7fe;
    }
</style>
@endsection
