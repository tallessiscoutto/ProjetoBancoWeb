@extends('layouts.app')

@section('title', 'Editar Fornecedor')

@section('page-title', 'Editar Fornecedor')
@section('page-description', 'Atualize os dados do fornecedor')

@section('content')

    <form action="{{ route('Fornecedores.atualizar', $fornecedor->id) }}" method="POST" class="form">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="nome">Nome/Razão Social</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome', $fornecedor->nome) }}" maxlength="80" required>
        </div>

        <div class="form-group">
            <label for="documento">CPF/CNPJ</label>
            <input type="text" class="form-control" id="documento" name="documento" value="{{ old('documento', $fornecedor->documento) }}" maxlength="18" required>
            <small class="form-text text-muted">Digite apenas números (11 dígitos para CPF ou 14 para CNPJ)</small>
        </div>

        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $fornecedor->email) }}" maxlength="100" required>
        </div>

        <div class="form-group">
            <label for="telefone">Telefone</label>
            <input type="tel" class="form-control" id="telefone" name="telefone" value="{{ old('telefone', $fornecedor->telefone) }}" maxlength="15" required>
            <small class="form-text text-muted">Digite apenas números (DDD + número)</small>
        </div>

        <div class="form-group">
            <label for="endereco">Endereço</label>
            <input type="text" class="form-control" id="endereco" name="endereco" value="{{ old('endereco', $fornecedor->endereco) }}" maxlength="100" required>
        </div>

        <div class="form-group">
            <label for="produtos_disponiveis">Produtos Disponíveis</label>
            <textarea class="form-control" id="produtos_disponiveis" name="produtos_disponiveis" rows="3" required>{{ old('produtos_disponiveis', $fornecedor->produtos_disponiveis) }}</textarea>
            <small class="form-text text-muted">Liste os produtos separados por vírgula ou nova linha</small>
        </div>

        <div class="form-group">
            <label for="formas_pagamento">Formas de Pagamento</label>
            <textarea class="form-control" id="formas_pagamento" name="formas_pagamento" rows="3" required>{{ old('formas_pagamento', $fornecedor->formas_pagamento) }}</textarea>
            <small class="form-text text-muted">Liste as formas de pagamento separadas por vírgula ou nova linha</small>
        </div>

        <div style="display: flex; gap: 1rem;">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i>
                Atualizar Fornecedor
            </button>
            
            <a href="{{ route('Fornecedores.cadastro') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i>
                Voltar
            </a>
        </div>
    </form>
@endsection

@section('scripts')
<script>
    // Máscara para CPF/CNPJ
    document.getElementById('documento').addEventListener('input', function (e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length <= 11) {
            // CPF
            value = value.replace(/(\d{3})(\d)/, '$1.$2');
            value = value.replace(/(\d{3})(\d)/, '$1.$2');
            value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
        } else {
            // CNPJ
            value = value.replace(/^(\d{2})(\d)/, '$1.$2');
            value = value.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
            value = value.replace(/\.(\d{3})(\d)/, '.$1/$2');
            value = value.replace(/(\d{4})(\d)/, '$1-$2');
        }
        e.target.value = value;
    });

    // Máscara para telefone
    document.getElementById('telefone').addEventListener('input', function (e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length <= 11) {
            if (value.length === 11) {
                // Celular
                value = value.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
            } else {
                // Telefone fixo
                value = value.replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
            }
            e.target.value = value;
        }
    });
</script>
@endsection