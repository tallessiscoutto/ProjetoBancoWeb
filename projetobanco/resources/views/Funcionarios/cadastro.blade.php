@extends('layouts.financeiro')

@section('title', 'Cadastrar Funcionário')

@section('page-title', 'Cadastro de Funcionários')
@section('page-description', 'Gerencie o cadastro de funcionários')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('Funcionarios.salvar') }}" method="POST" class="form">
        @csrf
        <div class="form-group">
            <label for="nome">Nome Completo</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome') }}" maxlength="100" required>
        </div>

        <div class="form-group">
            <label for="documento">CPF/CNPJ</label>
            <input type="text" class="form-control" id="documento" name="documento" value="{{ old('documento') }}" maxlength="18" required>
            <small class="form-text text-muted">Digite apenas números (11 dígitos para CPF ou 14 para CNPJ)</small>
        </div>

        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" maxlength="100" required>
        </div>

        <div class="form-group">
            <label for="telefone">Telefone</label>
            <input type="text" class="form-control" id="telefone" name="telefone" value="{{ old('telefone') }}" maxlength="15" required>
            <small class="form-text text-muted">Digite apenas números (10 ou 11 dígitos)</small>
        </div>

        <div class="form-group">
            <label for="endereco">Endereço</label>
            <input type="text" class="form-control" id="endereco" name="endereco" required>
        </div>

        <div class="form-group">
            <label for="cargo">Cargo</label>
            <input type="text" class="form-control" id="cargo" name="cargo" value="{{ old('cargo') }}" maxlength="50" required>
        </div>

        <div class="form-group">
            <label for="salario">Salário</label>
            <input type="text" class="form-control" id="salario" name="salario" value="{{ old('salario') }}" required>
            <small class="form-text text-muted">Digite o valor sem pontos ou vírgulas</small>
        </div>

        <div class="form-group">
            <label for="data_admissao">Data de Admissão</label>
            <input type="date" class="form-control" id="data_admissao" name="data_admissao" required>
        </div>

        <div style="display: flex; gap: 1rem;">
            <button type="submit" class="btn btn-primary">Cadastrar Funcionário</button>
            
            <a href="{{ route('home') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i>
                Voltar
            </a>
        </div>
    </form>

    @if(isset($funcionarios) && count($funcionarios) > 0)
        <div class="table-responsive" style="margin-top: 2rem;">
            <h3 style="margin-bottom: 1rem;">Funcionários Cadastrados</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>CPF/CNPJ</th>
                        <th>E-mail</th>
                        <th>Telefone</th>
                        <th>Cargo</th>
                        <th>Salário</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($funcionarios as $funcionario)
                        <tr>
                            <td>{{ $funcionario->nome }}</td>
                            <td>{{ \App\Helpers\FormatHelper::formatarDocumento($funcionario->documento) }}</td>
                            <td>{{ $funcionario->email }}</td>
                            <td>{{ \App\Helpers\FormatHelper::formatarTelefone($funcionario->telefone) }}</td>
                            <td>{{ $funcionario->cargo }}</td>
                            <td>R$ {{ number_format($funcionario->salario, 2, ',', '.') }}</td>
                            <td>
                                <div class="table-actions">
                                    <a href="{{ route('Funcionarios.editar', $funcionario->id) }}" class="btn btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('Funcionarios.excluir', $funcionario->id) }}" method="POST" style="display: inline-flex; align-items: center; margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este funcionário?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
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