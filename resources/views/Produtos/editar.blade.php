@extends('layouts.app')

@section('title', 'Editar Produto')

@section('page-title', 'Editar Produto')
@section('page-description', 'Atualize as informações do produto')

@section('content')
    <form action="{{ route('Produtos.atualizar', $produto->id) }}" method="POST" class="form" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="nome">Nome do Produto</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ $produto->nome }}" required>
        </div>

        <div class="form-group">
            <label for="marca">Marca</label>
            <input type="text" class="form-control" id="marca" name="marca" value="{{ $produto->marca }}">
        </div>

        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao" rows="3" maxlength="255">{{ $produto->descricao }}</textarea>
        </div>

        <div class="form-group">
            <label for="foto">Foto do Produto</label>
            <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
            <small class="text-muted">Formatos: JPG, PNG, WEBP. Tamanho máx: 2MB.</small>
        </div>

        @if(!empty($produto->foto))
        <div class="mb-3">
            <label class="form-label d-block">Foto atual</label>
            <img src="{{ asset('storage/' . $produto->foto) }}" alt="{{ $produto->nome }}" style="width:96px;height:96px;object-fit:cover;border-radius:8px;border:1px solid #eee;">
        </div>
        @endif

        <div class="form-group">
            <label for="preco">Preço</label>
            <input type="number" class="form-control" id="preco" name="preco" step="0.01" value="{{ $produto->preco }}" required>
        </div>

        <div class="form-group">
            <label for="quantidade">Quantidade em Estoque</label>
            <input type="number" class="form-control" id="quantidade" name="quantidade" value="{{ $produto->quantidade }}" required>
        </div>
        <div class="mb-3">
            <label for="localizacao" class="form-label">Localização (Ex: Estante A / Prateleira 3)</label>
            <input type="text" name="localizacao" id="localizacao" class="form-control" value="{{ $produto->localizacao }}">
        </div>

        <div class="form-group">
            <label for="fornecedor_id">Fornecedor</label>
            <select class="form-control" id="fornecedor_id" name="fornecedor_id" required>
                <option value="">Selecione um fornecedor</option>
                @foreach($fornecedores as $fornecedor)
                    <option value="{{ $fornecedor->id }}" {{ $produto->fornecedor_id == $fornecedor->id ? 'selected' : '' }}>
                        {{ $fornecedor->nome }}
                    </option>
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
                Atualizar Produto
            </button>
            
            <a href="{{ route('Produtos.cadastro') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i>
                Voltar
            </a>
        </div>
    </form>
@endsection
