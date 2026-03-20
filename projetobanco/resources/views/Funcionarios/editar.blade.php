@extends('layouts.app')

@section('title', 'Editar Funcionário')

@section('page-title', 'Editar Funcionário')
@section('page-description', 'Atualize os dados do funcionário')

@section('content')
    <form action="{{ route('Funcionarios.atualizar', $funcionario->id) }}" method="POST" class="form">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="nome">Nome Completo</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome', $funcionario->nome) }}" maxlength="100" required>
        </div>

        <div class="form-group">
            <label for="documento">CPF/CNPJ</label>
            <input type="text" class="form-control" id="documento" name="documento" value="{{ old('documento', $funcionario->documento) }}" maxlength="18" required>
            <small class="form-text text-muted">Digite apenas números (11 dígitos para CPF ou 14 para CNPJ)</small>
        </div>

        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $funcionario->email) }}" maxlength="100" required>
        </div>

        <div class="form-group">
            <label for="telefone">Telefone</label>
            <input type="tel" class="form-control" id="telefone" name="telefone" value="{{ old('telefone', $funcionario->telefone) }}" maxlength="15" required>
            <small class="form-text text-muted">Digite apenas números (DDD + número)</small>
        </div>

        <div class="form-group">
            <label for="cargo">Cargo</label>
            <input type="text" class="form-control" id="cargo" name="cargo" value="{{ old('cargo', $funcionario->cargo) }}" maxlength="50" required>
        </div>

        <div class="form-group">
            <label for="salario">Salário</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">R$</span>
                </div>
                <input type="text" class="form-control" id="salario" name="salario" value="{{ old('salario', number_format($funcionario->salario, 2, ',', '.')) }}" required>
            </div>
            <small class="form-text text-muted">Digite o valor sem pontos, usando vírgula para decimais (ex: 1234,56)</small>
        </div>

        <div style="display: flex; gap: 1rem;">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i>
                Atualizar Funcionário
            </button>
            
            <a href="{{ route('Funcionarios.cadastro') }}" class="btn btn-secondary">
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

    // Formatação do salário
    document.getElementById('salario').addEventListener('input', function (e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length > 0) {
            value = (parseFloat(value) / 100).toFixed(2);
            value = value.replace('.', ',');
            e.target.value = value;
        }
    });
</script>
@endsection