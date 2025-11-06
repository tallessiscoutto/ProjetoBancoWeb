@extends('layouts.financeiro')

@section('title','Reservas')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><h4 class="mb-0">Nova Reserva</h4></div>
            <div class="card-body">
                <form method="POST" action="{{ route('Reservas.salvar') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="cliente_id">Cliente</label>
                        <select class="form-select" id="cliente_id" name="cliente_id" required>
                            <option value="">Selecione</option>
                            @foreach($clientes as $c)
                                <option value="{{ $c->id }}">{{ $c->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="produto_id">Produto</label>
                        <select class="form-select" id="produto_id" name="produto_id" required>
                            <option value="">Selecione</option>
                            @foreach($produtos as $p)
                                <option value="{{ $p->id }}">#{{ $p->id }} · {{ $p->nome }} (Estoque: {{ $p->quantidade }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="quantidade">Quantidade</label>
                        <input class="form-control" type="number" id="quantidade" name="quantidade" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="data_validade">Validade</label>
                        <input class="form-control" type="date" id="data_validade" name="data_validade" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-save me-2"></i>Reservar</button>
                </form>
                @if($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Reservas</h4>
                    <form class="row g-2" method="GET" action="{{ route('Reservas.cadastro') }}">
                        <div class="col-auto">
                            <input type="text" class="form-control" name="cliente" placeholder="Cliente" value="{{ request('cliente') }}">
                        </div>
                        <div class="col-auto">
                            <input type="text" class="form-control" name="produto" placeholder="Produto" value="{{ request('produto') }}">
                        </div>
                        <div class="col-auto">
                            <select name="status" class="form-select">
                                <option value="">Status</option>
                                <option value="ativa" {{ request('status')==='ativa' ? 'selected' : '' }}>Ativa</option>
                                <option value="concluida" {{ request('status')==='concluida' ? 'selected' : '' }}>Concluída</option>
                                <option value="cancelada" {{ request('status')==='cancelada' ? 'selected' : '' }}>Cancelada</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <input type="date" class="form-control" name="inicio" value="{{ request('inicio') }}">
                        </div>
                        <div class="col-auto">
                            <input type="date" class="form-control" name="fim" value="{{ request('fim') }}">
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-primary" type="submit"><i class="fas fa-filter me-1"></i>Filtrar</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Cliente</th>
                                <th>Produto</th>
                                <th>Qtd</th>
                                <th>Validade</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reservas as $r)
                            <tr>
                                <td>{{ $r->id }}</td>
                                <td>{{ $r->cliente->nome }}</td>
                                <td>{{ $r->produto->nome }}</td>
                                <td>{{ $r->quantidade }}</td>
                                <td>{{ \Carbon\Carbon::parse($r->data_validade)->format('d/m/Y') }}</td>
                                <td>
                                    @if($r->status === 'ativa')
                                        <span class="badge bg-info">Ativa</span>
                                    @elseif($r->status === 'concluida')
                                        <span class="badge bg-success">Concluída</span>
                                    @else
                                        <span class="badge bg-secondary">Cancelada</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <form method="POST" action="{{ route('Reservas.concluir', $r->id) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success" {{ $r->status!=='ativa' ? 'disabled' : '' }}>
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('Reservas.cancelar', $r->id) }}" class="ms-2">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger" {{ $r->status!=='ativa' ? 'disabled' : '' }}>
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="7" class="text-center text-muted">Nenhuma reserva registrada</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $reservas->links() }}
            </div>
        </div>
    </div>
</div>
@endsection


