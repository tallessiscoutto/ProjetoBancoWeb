@extends('layouts.financeiro')

@section('title', 'Cadastrar Cliente')

@section('page-title', 'Cadastro de Clientes')
@section('page-description', 'Gerencie o cadastro de clientes')

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

    <form action="{{ route('Clientes.Salvar') }}" method="POST" class="form">
        @csrf
        <div class="form-group">
            <label for="nome">Nome/Razão Social</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome') }}" maxlength="80" required>
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
            <input type="text" class="form-control" id="endereco" name="endereco" value="{{ old('endereco') }}" maxlength="100" required>
        </div>

        <button type="submit" class="btn btn-primary">Cadastrar Cliente</button>
    </form>

    @if(isset($clientes) && count($clientes) > 0)
        <div class="table-responsive" style="margin-top: 2rem;">
            <h3 style="margin-bottom: 1rem;">Clientes Cadastrados</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>CPF/CNPJ</th>
                        <th>E-mail</th>
                        <th>Telefone</th>
                        <th>Endereço</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->nome }}</td>
                            <td>{{ \App\Helpers\FormatHelper::formatarDocumento($cliente->documento) }}</td>
                            <td>{{ $cliente->email }}</td>
                            <td>{{ \App\Helpers\FormatHelper::formatarTelefone($cliente->telefone) }}</td>
                            <td>{{ $cliente->endereco }}</td>
                            <td>
                                <div class="table-actions">
                                    <a href="{{ route('Clientes.editar', $cliente->id) }}" class="btn btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('Clientes.excluir', $cliente->id) }}" method="POST" style="display: inline-flex; align-items: center; margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este cliente?')">
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
    // Função para aplicar máscara de CPF/CNPJ
    function mascaraDocumento(valor) {
        valor = valor.replace(/\D/g, '');
        if (valor.length <= 11) {
            // CPF
            valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
            valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
            valor = valor.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
        } else {
            // CNPJ
            valor = valor.replace(/^(\d{2})(\d)/, '$1.$2');
            valor = valor.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
            valor = valor.replace(/\.(\d{3})(\d)/, '.$1/$2');
            valor = valor.replace(/(\d{4})(\d)/, '$1-$2');
        }
        return valor;
    }

    // Função para aplicar máscara de telefone
    function mascaraTelefone(valor) {
        valor = valor.replace(/\D/g, '');
        if (valor.length <= 11) {
            if (valor.length <= 10) {
                // Telefone fixo
                valor = valor.replace(/(\d{2})(\d)/, '($1) $2');
                valor = valor.replace(/(\d{4})(\d)/, '$1-$2');
            } else {
                // Celular
                valor = valor.replace(/(\d{2})(\d)/, '($1) $2');
                valor = valor.replace(/(\d{5})(\d)/, '$1-$2');
            }
        }
        return valor;
    }

    // Aplicar máscaras nos campos
    document.getElementById('documento').addEventListener('input', function(e) {
        e.target.value = mascaraDocumento(e.target.value);
    });

    document.getElementById('telefone').addEventListener('input', function(e) {
        e.target.value = mascaraTelefone(e.target.value);
    });
</script>
@endsection