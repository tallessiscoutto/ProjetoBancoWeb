@extends('layouts.app')

@section('title', 'Cadastro de Produtos')

@section('page-title', 'Cadastro de Produtos')
@section('page-description', 'Adicione novos produtos ao catálogo')

@section('content')
<form action="{{ route('Produtos.salvar') }}" method="POST" class="form" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="nome">Nome do Produto</label>
        <input type="text" class="form-control" id="nome" name="nome" required>
    </div>

    <div class="form-group">
        <label for="marca">Marca</label>
        <input type="text" class="form-control" id="marca" name="marca">
    </div>

    <div class="form-group">
        <label for="descricao">Descrição</label>
        <textarea class="form-control" id="descricao" name="descricao" rows="3" maxlength="255"></textarea>
    </div>
    <div class="form-group">
        <label for="foto">Foto do Produto</label>
        <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
        <small class="text-muted">Formatos: JPG, PNG, WEBP. Tamanho máx: 2MB.</small>
    </div>
    <div class="form-group">
        <label for="preco">Preço</label>
        <input type="number" class="form-control" id="preco" name="preco" step="0.01" required>
    </div>

    <div class="form-group">
        <label for="quantidade">Quantidade em Estoque</label>
        <input type="number" class="form-control" id="quantidade" name="quantidade" required>
    </div>
    <div class="mb-3">
        <label for="localizacao" class="form-label">Localização (Ex: Estante A / Prateleira 3)</label>
        <input type="text" name="localizacao" id="localizacao" class="form-control">
    </div>
    <div class="form-group">
        <label for="fornecedor_id">Fornecedor</label>
        <select class="form-control" id="fornecedor_id" name="fornecedor_id" required>
            <option value="">Selecione um fornecedor</option>
            @foreach($fornecedores as $fornecedor)
                <option value="{{ $fornecedor->id }}">{{ $fornecedor->nome }}</option>
            @endforeach
        </select>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div style="display: flex; gap: 1rem;">
        <button type="submit" class="btn btn-success">
            <i class="fas fa-save"></i>
            Salvar Produto
        </button>

        <a href="{{ route('home') }}" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i>
            Voltar
        </a>
    </div>
</form>

@if(isset($produtos) && count($produtos) > 0)
<div class="table-responsive" style="margin-top: 2rem;">
    <h3 style="margin-bottom: 1rem;">Produtos Cadastrados</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Marca</th>
                <th>Foto</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Fornecedor</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produtos as $produto)
            <tr>
                <td>{{ $produto->nome }}</td>
                <td>{{ $produto->marca ?? '—' }}</td>
                <td>
                    @if(!empty($produto->foto))
                        <img src="{{ asset('storage/' . $produto->foto) }}" alt="{{ $produto->nome }}" style="width:48px;height:48px;object-fit:cover;border-radius:6px;">
                    @else
                        <span class="text-muted">—</span>
                    @endif
                </td>
                <td>R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                <td>{{ $produto->quantidade }}</td>
                <td>{{ $produto->fornecedor->nome }}</td>
                <td style="display: flex; gap: 0.5rem;">
                    <a href="{{ route('Produtos.editar', $produto->id) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="{{ route('Produtos.visualizar', $produto->id) }}" class="btn btn-info">
                        <i class="fas fa-eye"></i>
                    </a>
                    <form action="{{ route('Produtos.excluir', $produto->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Tem certeza que deseja excluir este produto?')">
                            <i class="fas fa-trash"></i>
                        </button>

                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
@endsection