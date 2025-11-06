@extends('layouts.financeiro')

@section('title', 'Cadastrar Produto')

@section('styles')
<style>
    .produtos-page {
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
        overflow-x: hidden;
    }

    .produtos-page form,
    .produtos-page .stats-grid,
    .produtos-page .table-responsive {
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
    }

    .produtos-page .table-responsive {
        overflow-x: auto;
    }

    /* Espaçamento dos cards de estatísticas */
    .produtos-page .stats-grid {
        margin-bottom: 3rem !important;
        gap: 2rem !important;
    }

    .produtos-page .stats-card {
        padding: 2.5rem !important;
    }

    /* Espaçamento do formulário */
    .produtos-page form {
        margin-top: 3rem;
        padding: 3rem;
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .produtos-page .form-group {
        margin-bottom: 2.5rem !important;
    }

    .produtos-page .form-group label {
        margin-bottom: 1rem !important;
        display: block;
        font-weight: 500;
        color: #2c3e50;
        font-size: 1rem;
    }

    .produtos-page .form-control,
    .produtos-page select {
        padding: 1rem 1.25rem !important;
        margin-bottom: 0;
        font-size: 1rem;
        border-radius: 8px;
        border: 1px solid #ddd;
    }

    .produtos-page .form-control:focus,
    .produtos-page select:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        outline: none;
    }

    .produtos-page textarea.form-control {
        min-height: 100px;
        resize: vertical;
    }

    .produtos-page .mb-3 {
        margin-bottom: 2.5rem !important;
    }

    .produtos-page .mb-3 label {
        margin-bottom: 1rem !important;
        display: block;
        font-weight: 500;
        color: #2c3e50;
        font-size: 1rem;
    }

    .produtos-page small.text-muted {
        display: block;
        margin-top: 0.75rem;
        font-size: 0.875rem;
        color: #6c757d;
        line-height: 1.5;
    }

    .produtos-page button[type="submit"] {
        margin-top: 2rem;
        padding: 1rem 2.5rem;
        font-size: 1.1rem;
        font-weight: 600;
    }

    .produtos-page .table-responsive {
        margin-top: 4rem;
    }

    .produtos-page .table-responsive h3 {
        margin-bottom: 2rem !important;
        font-size: 1.5rem;
        color: #2c3e50;
    }

    @media (max-width: 768px) {
        .produtos-page .stats-grid {
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)) !important;
            gap: 1rem !important;
        }

        .produtos-page .stats-card {
            padding: 1.5rem !important;
        }

        .produtos-page form {
            padding: 1.5rem;
        }

        .produtos-page .form-group {
            margin-bottom: 2rem !important;
        }

        .produtos-page .mb-3 {
            margin-bottom: 2rem !important;
        }
    }
</style>
@endsection

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

<div class="produtos-page">
    @isset($stats)
    <div class="stats-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 2rem; margin-bottom: 3rem; width: 100%; max-width: 100%;">
        <div class="stats-card" style="background: white; padding: 2.5rem; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="width: 50px; height: 50px; background: #3498db; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem; flex-shrink: 0;">
                    <i class="fas fa-box"></i>
                </div>
                <div style="min-width: 0; flex: 1;">
                    <h3 style="font-size: 2rem; margin: 0; color: #2c3e50; word-wrap: break-word;">{{ $stats['total'] }}</h3>
                    <p style="color: #666; margin: 0; font-size: 0.9rem;">Total de Produtos</p>
                </div>
            </div>
        </div>
        <div class="stats-card" style="background: white; padding: 1.5rem; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="width: 50px; height: 50px; background: #f1c40f; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem; flex-shrink: 0;">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div style="min-width: 0; flex: 1;">
                    <h3 style="font-size: 2rem; margin: 0; color: #2c3e50; word-wrap: break-word;">{{ $stats['estoque_baixo'] }}</h3>
                    <p style="color: #666; margin: 0; font-size: 0.9rem;">Estoque Baixo</p>
                </div>
            </div>
        </div>
        <div class="stats-card" style="background: white; padding: 1.5rem; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="width: 50px; height: 50px; background: #e74c3c; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem; flex-shrink: 0;">
                    <i class="fas fa-times-circle"></i>
                </div>
                <div style="min-width: 0; flex: 1;">
                    <h3 style="font-size: 2rem; margin: 0; color: #2c3e50; word-wrap: break-word;">{{ $stats['sem_estoque'] }}</h3>
                    <p style="color: #666; margin: 0; font-size: 0.9rem;">Sem Estoque</p>
                </div>
            </div>
        </div>
        <div class="stats-card" style="background: white; padding: 1.5rem; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="width: 50px; height: 50px; background: #27ae60; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem; flex-shrink: 0;">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div style="min-width: 0; flex: 1;">
                    <h3 style="font-size: 1.2rem; margin: 0; color: #2c3e50; word-wrap: break-word; overflow-wrap: break-word; line-height: 1.3;">R$ {{ number_format($stats['valor_total'], 2, ',', '.') }}</h3>
                    <p style="color: #666; margin: 0; font-size: 0.9rem;">Valor Total</p>
                </div>
            </div>
        </div>
    </div>
    @endisset

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

        <button type="submit" class="btn btn-primary">Cadastrar Produto</button>
    </form>

    @if(isset($produtos) && count($produtos) > 0)
    <div class="table-responsive">
        <h3 style="margin-bottom: 2rem; margin-top: 0;">Produtos Cadastrados</h3>
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
                    <td style="text-align: center;">
                        @if(!empty($produto->foto))
                        <img src="{{ asset('storage/' . $produto->foto) }}" alt="{{ $produto->nome }}" style="width:48px;height:48px;object-fit:cover;border-radius:6px;">
                        @else
                        <span class="text-muted">—</span>
                        @endif
                    </td>
                    <td>R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                    <td style="text-align: center;">{{ $produto->quantidade }}</td>
                    <td>{{ $produto->fornecedor->nome }}</td>
                    <td>
                        <div class="table-actions">
                            <a href="{{ route('Produtos.editar', $produto->id) }}" class="btn btn-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" class="btn btn-info" onclick="visualizarProduto({{ $produto->id }})" data-bs-toggle="modal" data-bs-target="#modalVisualizarProduto">
                                <i class="fas fa-eye"></i>
                            </button>
                            <form action="{{ route('Produtos.excluir', $produto->id) }}" method="POST" style="display: inline-flex; align-items: center; margin: 0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Tem certeza que deseja excluir este produto?')">
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

    <!-- Modal para Visualizar Produto -->
    <div class="modal fade" id="modalVisualizarProduto" tabindex="-1" aria-labelledby="modalVisualizarProdutoLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(135deg, #3498db 0%, #2980b9 100%); color: white;">
                    <h5 class="modal-title" id="modalVisualizarProdutoLabel">
                        <i class="fas fa-box me-2"></i>Detalhes do Produto
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="loadingProduto" class="text-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Carregando...</span>
                        </div>
                        <p class="mt-3">Carregando informações do produto...</p>
                    </div>
                    <div id="conteudoProduto" style="display: none;">
                        <div class="row">
                            <div class="col-md-4 text-center mb-4">
                                <div id="produtoFoto" class="mb-3">
                                    <img src="" alt="Foto do Produto" class="img-fluid rounded shadow" style="max-height: 300px; width: 100%; object-fit: cover;">
                                </div>
                                <div id="produtoSemFoto" style="display: none;">
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 300px;">
                                        <i class="fas fa-image fa-5x text-muted"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <h3 class="mb-3" id="produtoNome" style="color: #2c3e50;"></h3>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card border-0 shadow-sm h-100">
                                            <div class="card-body">
                                                <h6 class="text-muted mb-2"><i class="fas fa-hashtag me-2"></i>ID do Produto</h6>
                                                <p class="mb-0 fw-bold fs-5" id="produtoId">—</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card border-0 shadow-sm h-100">
                                            <div class="card-body">
                                                <h6 class="text-muted mb-2"><i class="fas fa-tag me-2"></i>Marca</h6>
                                                <p class="mb-0 fw-bold fs-5" id="produtoMarca">—</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card border-0 shadow-sm h-100">
                                            <div class="card-body">
                                                <h6 class="text-muted mb-2"><i class="fas fa-dollar-sign me-2"></i>Preço</h6>
                                                <p class="mb-0 fw-bold fs-4 text-success" id="produtoPreco">—</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card border-0 shadow-sm h-100">
                                            <div class="card-body">
                                                <h6 class="text-muted mb-2"><i class="fas fa-boxes me-2"></i>Quantidade em Estoque</h6>
                                                <p class="mb-0 fw-bold fs-4" id="produtoQuantidade">—</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-body">
                                                <h6 class="text-muted mb-2"><i class="fas fa-truck me-2"></i>Fornecedor</h6>
                                                <p class="mb-0 fw-bold" id="produtoFornecedor">—</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-body">
                                                <h6 class="text-muted mb-2"><i class="fas fa-map-marker-alt me-2"></i>Localização</h6>
                                                <p class="mb-0 fw-bold" id="produtoLocalizacao">—</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-body">
                                                <h6 class="text-muted mb-2"><i class="fas fa-align-left me-2"></i>Descrição</h6>
                                                <p class="mb-0" id="produtoDescricao" style="min-height: 60px;">—</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-body">
                                                <h6 class="text-muted mb-2"><i class="fas fa-calendar-plus me-2"></i>Data de Cadastro</h6>
                                                <p class="mb-0 fw-bold" id="produtoDataCadastro">—</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-body">
                                                <h6 class="text-muted mb-2"><i class="fas fa-calendar-edit me-2"></i>Última Atualização</h6>
                                                <p class="mb-0 fw-bold" id="produtoDataAtualizacao">—</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <a href="#" id="btnEditarProduto" class="btn btn-primary">
                        <i class="fas fa-edit me-2"></i>Editar Produto
                    </a>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
    <script>
        function visualizarProduto(id) {
            // Mostra loading e esconde conteúdo
            document.getElementById('loadingProduto').style.display = 'block';
            document.getElementById('conteudoProduto').style.display = 'none';

            // Faz requisição para buscar dados do produto
            fetch(`/Produtos/show/${id}`)
                .then(response => response.json())
                .then(produto => {
                    // Preenche os campos do modal
                    document.getElementById('produtoId').textContent = `#${produto.id.toString().padStart(3, '0')}`;
                    document.getElementById('produtoNome').textContent = produto.nome;
                    document.getElementById('produtoMarca').textContent = produto.marca || 'Não informado';
                    document.getElementById('produtoPreco').textContent = `R$ ${parseFloat(produto.preco).toLocaleString('pt-BR', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
                    document.getElementById('produtoQuantidade').textContent = produto.quantidade;
                    document.getElementById('produtoFornecedor').textContent = produto.fornecedor ? produto.fornecedor.nome : 'Não informado';
                    document.getElementById('produtoLocalizacao').textContent = produto.localizacao || 'Não informado';
                    document.getElementById('produtoDescricao').textContent = produto.descricao || 'Nenhuma descrição disponível';

                    // Formata datas
                    const dataCadastro = new Date(produto.created_at);
                    const dataAtualizacao = new Date(produto.updated_at);
                    document.getElementById('produtoDataCadastro').textContent = dataCadastro.toLocaleDateString('pt-BR') + ' ' + dataCadastro.toLocaleTimeString('pt-BR', {
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                    document.getElementById('produtoDataAtualizacao').textContent = dataAtualizacao.toLocaleDateString('pt-BR') + ' ' + dataAtualizacao.toLocaleTimeString('pt-BR', {
                        hour: '2-digit',
                        minute: '2-digit'
                    });

                    // Configura foto
                    if (produto.foto) {
                        document.getElementById('produtoFoto').querySelector('img').src = `/storage/${produto.foto}`;
                        document.getElementById('produtoFoto').style.display = 'block';
                        document.getElementById('produtoSemFoto').style.display = 'none';
                    } else {
                        document.getElementById('produtoFoto').style.display = 'none';
                        document.getElementById('produtoSemFoto').style.display = 'block';
                    }

                    // Configura link de editar
                    document.getElementById('btnEditarProduto').href = `/Produtos/editar/${produto.id}`;

                    // Esconde loading e mostra conteúdo
                    document.getElementById('loadingProduto').style.display = 'none';
                    document.getElementById('conteudoProduto').style.display = 'block';
                })
                .catch(error => {
                    console.error('Erro ao carregar produto:', error);
                    document.getElementById('loadingProduto').innerHTML = '<p class="text-danger">Erro ao carregar informações do produto.</p>';
                });
        }
    </script>
    @endsection
</div>