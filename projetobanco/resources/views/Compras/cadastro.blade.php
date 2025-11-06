@extends('layouts.financeiro')

@section('title', 'Gestão de Compras')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Nova Compra</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('Compras.salvar') }}" id="formCompra">
                    @csrf
                    <div class="mb-3">
                        <label for="funcionario_id" class="form-label">Funcionário Responsável</label>
                        <select name="funcionario_id" id="funcionario_id" class="form-select" required>
                            <option value="">Selecione um Funcionário</option>
                            @isset($funcionarios)
                                @foreach($funcionarios as $f)
                                    <option value="{{ $f->id }}">{{ $f->nome }}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="produto_id" class="form-label">Produto</label>
                        <select name="produto_id" id="produto_id" class="form-select" required>
                            <option value="">Selecione um Produto</option>
                            @foreach($produtos as $produto)
                                <option value="{{ $produto->id }}" data-preco="{{ $produto->preco }}">
                                    {{ $produto->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="quantidade" class="form-label">Quantidade</label>
                        <input type="number" name="quantidade" id="quantidade" 
                            class="form-control" required min="1"
                            oninput="calcularTotal()">
                    </div>

                    <div class="mb-3">
                        <label for="preco_total" class="form-label">Preço Total</label>
                        <div class="input-group">
                            <span class="input-group-text">R$</span>
                            <input type="number" name="preco_total" id="preco_total" 
                                class="form-control" required step="0.01">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="data_compra" class="form-label">Data da Compra</label>
                        <input type="date" name="data_compra" id="data_compra" 
                            class="form-control" required
                            value="{{ date('Y-m-d') }}">
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-save me-2"></i>Cadastrar Compra
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Histórico de Compras</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Produto</th>
                                <th>Funcionário</th>
                                <th>Quantidade</th>
                                <th>Preço Total</th>
                                <th>Data</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($compras as $compra)
                                <tr>
                                    <td>{{ $compra->id }}</td>
                                    <td>{{ $compra->produto->nome }}</td>
                                    <td>{{ optional($compra->funcionario)->nome ?? '—' }}</td>
                                    <td>{{ $compra->quantidade }}</td>
                                    <td>R$ {{ number_format($compra->preco_total, 2, ',', '.') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($compra->data_compra)->format('d/m/Y') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('Compras.editar', $compra->id) }}" 
                                                class="btn btn-sm btn-warning me-2">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('Compras.excluir', $compra->id) }}" 
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Deseja excluir esta compra?')">
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
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function calcularTotal() {
    const produto = document.getElementById('produto_id');
    const quantidade = document.getElementById('quantidade').value;
    const precoUnitario = produto.options[produto.selectedIndex].dataset.preco;
    
    if (quantidade && precoUnitario) {
        const total = quantidade * precoUnitario;
        document.getElementById('preco_total').value = total.toFixed(2);
    }
}

$(document).ready(function() {
    // Inicializa select2 se disponível
    if ($.fn.select2) {
        $('#produto_id').select2({
            theme: 'bootstrap-5',
            placeholder: 'Selecione um produto'
        });
    }

    // Inicializa DataTable se disponível
    if ($.fn.DataTable) {
        $('.table').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json'
            }
        });
    }

    // Formata valores monetários
    $('.money').mask('#.##0,00', {reverse: true});
});
</script>
@endsection
