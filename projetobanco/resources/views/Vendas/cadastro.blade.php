@extends('layouts.financeiro')

@section('title', 'Vendas')

@section('content')
<style>
    .vendas-container {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        padding: 1.5rem;
        margin-bottom: 1rem;
    }
    
    .vendas-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 1rem;
        border-bottom: 2px solid #e1e1e1;
        margin-bottom: 1.5rem;
    }
    
    .vendas-header h2 {
        margin: 0;
        color: #2c3e50;
    }
    
    .vendas-content {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }
    
    .produtos-table-container {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 1rem;
        max-height: 400px;
        overflow-y: auto;
    }
    
    .produtos-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .produtos-table th {
        background: #2c3e50;
        color: white;
        padding: 0.75rem;
        text-align: left;
        font-weight: 600;
        position: sticky;
        top: 0;
        z-index: 10;
    }
    
    .produtos-table td {
        padding: 0.75rem;
        border-bottom: 1px solid #dee2e6;
        background: white;
    }
    
    .produtos-table tr:hover td {
        background: #f8f9fa;
    }
    
    .produtos-table input[type="number"]:focus {
        outline: 2px solid #3498db;
        border-color: #3498db;
    }
    
    .logo-panel {
        background: #e3f2fd;
        border-radius: 8px;
        padding: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 400px;
    }
    
    .logo-box {
        background: #1976d2;
        color: white;
        padding: 3rem;
        border-radius: 8px;
        text-align: center;
        font-size: 1.2rem;
        font-weight: 600;
    }
    
    .vendas-controls {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
        margin-bottom: 1rem;
    }
    
    .control-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .control-group label {
        font-weight: 600;
        color: #2c3e50;
        font-size: 0.9rem;
    }
    
    .control-group input,
    .control-group select {
        padding: 0.5rem;
        border: 2px solid #e1e1e1;
        border-radius: 6px;
        font-size: 0.9rem;
    }
    
    .control-group input:focus,
    .control-group select:focus {
        outline: none;
        border-color: #3498db;
    }
    
    .btn-consultar {
        background: #95a5a6;
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
        margin-top: 1.5rem;
        transition: background 0.3s;
    }
    
    .btn-consultar:hover {
        background: #7f8c8d;
    }
    
    .vendas-footer {
        display: grid;
        grid-template-columns: 1fr 1fr 2fr;
        gap: 1rem;
        align-items: end;
    }
    
    .total-display {
        background: #f8f9fa;
        padding: 1rem;
        border-radius: 8px;
        text-align: center;
        border: 2px solid #e1e1e1;
    }
    
    .total-display h3 {
        margin: 0;
        color: #2c3e50;
        font-size: 1.5rem;
    }
    
    .total-display .valor {
        color: #27ae60;
        font-size: 2rem;
        font-weight: bold;
    }
    
    .vendas-actions {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
    }
    
    .btn-reservar {
        background: #f39c12;
        color: white;
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        font-size: 1rem;
        transition: background 0.3s;
    }
    
    .btn-reservar:hover {
        background: #e67e22;
    }
    
    .btn-finalizar {
        background: #27ae60;
        color: white;
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        font-size: 1rem;
        transition: background 0.3s;
    }
    
    .btn-finalizar:hover {
        background: #229954;
    }
    
    .sugestoes-box {
        position: absolute;
        background: white;
        border: 1px solid #ddd;
        border-radius: 6px;
        max-height: 200px;
        overflow-y: auto;
        z-index: 1000;
        width: 100%;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        display: none;
    }
    
    .sugestao-item {
        padding: 0.75rem;
        cursor: pointer;
        border-bottom: 1px solid #eee;
    }
    
    .sugestao-item:hover {
        background: #f8f9fa;
    }
    
    .sugestao-item:last-child {
        border-bottom: none;
    }
    
    .btn-remover {
        background: #e74c3c;
        color: white;
        border: none;
        padding: 0.4rem 0.8rem;
        border-radius: 6px;
        cursor: pointer;
        font-size: 0.85rem;
        transition: background 0.3s;
    }
    
    .btn-remover:hover {
        background: #c0392b;
    }
    
    .produto-no-carrinho {
        background: #d5f4e6 !important;
    }
    
    .produto-no-carrinho td {
        background: #d5f4e6 !important;
    }
</style>

<div class="vendas-container">
    <div class="vendas-header">
        <h2>Vendas</h2>
    </div>
    
    <div class="vendas-content">
        <!-- Tabela de Produtos (apenas produtos selecionados) -->
        <div class="produtos-table-container">
            <table class="produtos-table">
                <thead>
                    <tr>
                        <th>Descrição</th>
                        <th>Marca</th>
                        <th>Preço</th>
                        <th>Código</th>
                        <th>Quantidade</th>
                        <th>Total</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody id="tabelaProdutos">
                    <tr id="tabelaVazia">
                        <td colspan="7" style="text-align: center; padding: 2rem; color: #95a5a6;">
                            <i class="fas fa-box fa-3x" style="opacity: 0.3; margin-bottom: 1rem; display: block;"></i>
                            <p>Nenhum produto adicionado à venda</p>
                            <small>Use o campo "Produto" acima para buscar e adicionar produtos</small>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- Painel de Logo -->
        <div class="logo-panel">
            <div class="logo-box">
                Logomarca
            </div>
        </div>
    </div>
    
    <!-- Controles -->
    <div class="vendas-controls">
        <div class="control-group">
            <label for="campoProduto">Produto</label>
            <div style="position: relative;">
                <input type="text" id="campoProduto" class="form-control" placeholder="Nome ou código">
                <div id="sugestoesProduto" class="sugestoes-box"></div>
            </div>
            <button type="button" class="btn-consultar" onclick="consultarProduto()">Consultar</button>
        </div>
        
        <div class="control-group">
            <label for="campoCliente">Cliente</label>
            <div style="position: relative;">
                <input type="text" id="campoCliente" class="form-control" placeholder="Nome, documento ou email">
                <div id="sugestoesCliente" class="sugestoes-box"></div>
            </div>
            <button type="button" class="btn-consultar" onclick="consultarCliente()">Consultar</button>
        </div>
        
        <div class="control-group">
            <label for="formaPagamento">Forma de pagamento</label>
            <select id="formaPagamento" class="form-control">
                <option value="Dinheiro">Dinheiro</option>
                <option value="Cartão de Crédito">Cartão de Crédito</option>
                <option value="Cartão de Débito">Cartão de Débito</option>
                <option value="PIX">PIX</option>
                <option value="Boleto">Boleto</option>
            </select>
        </div>
        
        <div class="control-group">
            <label for="funcionario_id">Funcionário</label>
            <select id="funcionario_id" class="form-control">
                <option value="">Selecione</option>
                @foreach($funcionarios as $f)
                    <option value="{{ $f->id }}">{{ $f->nome }}</option>
                @endforeach
            </select>
        </div>
    </div>
    
    <!-- Rodapé -->
    <div class="vendas-footer">
        <div class="control-group">
            <label for="dataVenda">Data</label>
            <input type="date" id="dataVenda" class="form-control" value="{{ date('Y-m-d') }}">
        </div>
        
        <div class="total-display">
            <h3>Total: <span class="valor" id="totalVenda">R$ 0,00</span></h3>
        </div>
        
        <div class="vendas-actions">
            <button type="button" class="btn-reservar" onclick="reservarItens()">
                Reservar Itens
            </button>
            <button type="button" class="btn-finalizar" onclick="finalizarVenda()">
                Finalizar Venda
            </button>
        </div>
    </div>
</div>

<!-- Seção do Carrinho (removida - produtos agora aparecem na tabela principal) -->

@endsection

@section('scripts')
<script>
let carrinho = [];
let produtoSelecionado = null;
let clienteSelecionado = null;

function formatarMoeda(valor) {
    return valor.toLocaleString('pt-BR', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });
}

function buscarProduto(termo) {
    if (!termo || termo.length < 2) {
        document.getElementById('sugestoesProduto').style.display = 'none';
        return;
    }
    
    fetch('{{ route("Vendas.buscar") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: `termo=${encodeURIComponent(termo)}`
    })
    .then(r => r.json())
    .then(data => {
        const box = document.getElementById('sugestoesProduto');
        box.innerHTML = '';
        if (data.success && data.resultados && data.resultados.length) {
            data.resultados.forEach(item => {
                const div = document.createElement('div');
                div.className = 'sugestao-item';
                div.textContent = `#${item.id} · ${item.nome} (${item.marca || 'Sem marca'}) - R$ ${formatarMoeda(parseFloat(item.preco))}`;
                div.onclick = () => {
                    selecionarProduto(item.id);
                    box.style.display = 'none';
                };
                box.appendChild(div);
            });
            box.style.display = 'block';
        } else {
            box.style.display = 'none';
        }
    })
    .catch(() => {});
}

function buscarCliente(termo) {
    if (!termo || termo.length < 2) {
        document.getElementById('sugestoesCliente').style.display = 'none';
        return;
    }
    
    fetch('{{ route("Vendas.buscarCliente") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: `termo=${encodeURIComponent(termo)}`
    })
    .then(r => r.json())
    .then(data => {
        const box = document.getElementById('sugestoesCliente');
        box.innerHTML = '';
        if (data.success && data.resultados && data.resultados.length) {
            data.resultados.forEach(item => {
                const div = document.createElement('div');
                div.className = 'sugestao-item';
                div.textContent = `${item.nome} - ${item.documento || item.email}`;
                div.onclick = () => {
                    selecionarCliente(item.id);
                    box.style.display = 'none';
                };
                box.appendChild(div);
            });
            box.style.display = 'block';
        } else {
            box.style.display = 'none';
        }
    })
    .catch(() => {});
}

function selecionarProduto(produtoId) {
    fetch('{{ route("Vendas.buscar") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: `produto_id=${produtoId}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            produtoSelecionado = data.produto;
            // Adicionar ao carrinho
            const quantidade = prompt('Quantidade:', '1');
            if (quantidade && parseInt(quantidade) > 0) {
                adicionarAoCarrinho(data.produto, parseInt(quantidade));
            }
        }
    });
}

function selecionarCliente(clienteId) {
    fetch('{{ route("Vendas.buscarCliente") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: `cliente_id=${clienteId}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            clienteSelecionado = data.cliente;
            document.getElementById('campoCliente').value = data.cliente.nome;
        }
    });
}

function adicionarAoCarrinho(produto, quantidade) {
    const existente = carrinho.find(item => item.id === produto.id);
    if (existente) {
        existente.quantidade += quantidade;
        existente.total = existente.quantidade * existente.preco;
    } else {
        carrinho.push({
            id: produto.id,
            nome: produto.nome,
            marca: produto.marca,
            preco: parseFloat(produto.preco),
            quantidade: quantidade,
            total: quantidade * parseFloat(produto.preco)
        });
    }
    atualizarCarrinho();
    atualizarTotal();
    atualizarTabelaProdutos();
}

function removerDoCarrinho(produtoId) {
    if (confirm('Deseja remover este produto da venda?')) {
        carrinho = carrinho.filter(item => item.id !== produtoId);
        atualizarTabelaProdutos();
        atualizarCarrinho();
        atualizarTotal();
    }
}

function atualizarCarrinho() {
    // Função mantida para compatibilidade, mas agora a tabela principal exibe os produtos
    // A atualização é feita por atualizarTabelaProdutos()
}

function atualizarTabelaProdutos() {
    const tbody = document.getElementById('tabelaProdutos');
    const tabelaVazia = document.getElementById('tabelaVazia');
    
    // Limpar tabela (exceto a linha de vazio)
    const linhasExistentes = tbody.querySelectorAll('tr[data-produto-id]');
    linhasExistentes.forEach(linha => linha.remove());
    
    if (carrinho.length === 0) {
        // Se o carrinho estiver vazio, mostrar mensagem
        if (!tabelaVazia) {
            const tr = document.createElement('tr');
            tr.id = 'tabelaVazia';
            tr.innerHTML = `
                <td colspan="7" style="text-align: center; padding: 2rem; color: #95a5a6;">
                    <i class="fas fa-box fa-3x" style="opacity: 0.3; margin-bottom: 1rem; display: block;"></i>
                    <p>Nenhum produto adicionado à venda</p>
                    <small>Use o campo "Produto" acima para buscar e adicionar produtos</small>
                </td>
            `;
            tbody.appendChild(tr);
        } else {
            tabelaVazia.style.display = '';
        }
        return;
    }
    
    // Ocultar mensagem de vazio
    if (tabelaVazia) {
        tabelaVazia.style.display = 'none';
    }
    
    // Adicionar produtos do carrinho à tabela
    carrinho.forEach(item => {
        const row = document.createElement('tr');
        row.setAttribute('data-produto-id', item.id);
        row.classList.add('produto-no-carrinho');
        row.innerHTML = `
            <td>${item.nome}</td>
            <td>${item.marca || '—'}</td>
            <td>R$ ${formatarMoeda(item.preco)}</td>
            <td>${String(item.id).padStart(3, '0')}</td>
            <td>
                <input type="number" 
                       value="${item.quantidade}" 
                       min="1" 
                       style="width: 70px; padding: 0.3rem; border: 1px solid #ddd; border-radius: 4px; text-align: center;"
                       onchange="atualizarQuantidade(${item.id}, this.value)">
            </td>
            <td><strong>R$ ${formatarMoeda(item.total)}</strong></td>
            <td>
                <button type="button" class="btn-remover" onclick="removerDoCarrinho(${item.id})" title="Remover produto">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        `;
        tbody.appendChild(row);
    });
}

function atualizarQuantidade(produtoId, novaQuantidade) {
    const quantidade = parseInt(novaQuantidade);
    if (quantidade < 1) {
        alert('Quantidade deve ser maior que zero!');
        atualizarTabelaProdutos();
        return;
    }
    
    const item = carrinho.find(item => item.id === produtoId);
    if (item) {
        item.quantidade = quantidade;
        item.total = quantidade * item.preco;
        atualizarTabelaProdutos();
        atualizarCarrinho();
        atualizarTotal();
    }
}

function atualizarTotal() {
    const total = carrinho.reduce((sum, item) => sum + item.total, 0);
    document.getElementById('totalVenda').textContent = `R$ ${formatarMoeda(total)}`;
}

function consultarProduto() {
    const termo = document.getElementById('campoProduto').value;
    if (termo) {
        buscarProduto(termo);
    }
}

function consultarCliente() {
    const termo = document.getElementById('campoCliente').value;
    if (termo) {
        buscarCliente(termo);
    }
}

function reservarItens() {
    if (carrinho.length === 0) {
        alert('Adicione produtos ao carrinho antes de reservar!');
        return;
    }
    // Levar para a tela de reservas com o último produto adicionado pré-selecionado
    const item = carrinho[carrinho.length - 1];
    const produtoId = item.id;
    const quantidade = item.quantidade || 1;
    const clienteId = clienteSelecionado ? clienteSelecionado.id : '';

    let url = '{{ route('Reservas.cadastro') }}';
    const params = new URLSearchParams();
    params.append('produto_id', produtoId);
    params.append('quantidade', quantidade);
    if (clienteId) params.append('cliente_id', clienteId);

    window.location.href = url + '?' + params.toString();
}

function finalizarVenda() {
    if (carrinho.length === 0) {
        alert('Adicione pelo menos um produto ao carrinho!');
        return;
    }
    
    const funcId = document.getElementById('funcionario_id').value;
    if (!funcId) {
        alert('Selecione o funcionário responsável pela venda.');
        return;
    }
    
    if (confirm('Deseja finalizar esta venda?')) {
        const dadosVenda = carrinho.map(item => ({
            produto_id: item.id,
            quantidade: item.quantidade,
            preco_total: item.total
        }));
        
        fetch('{{ route("Vendas.salvar") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                produtos: dadosVenda,
                funcionario_id: funcId,
                cliente_id: clienteSelecionado ? clienteSelecionado.id : null,
                forma_pagamento: document.getElementById('formaPagamento').value,
                data_venda: document.getElementById('dataVenda').value
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Venda realizada com sucesso!');
                carrinho = [];
                clienteSelecionado = null;
                produtoSelecionado = null;
                document.getElementById('campoProduto').value = '';
                document.getElementById('campoCliente').value = '';
                atualizarTabelaProdutos();
                atualizarCarrinho();
                atualizarTotal();
            } else {
                alert('Erro ao realizar venda: ' + (data.message || 'Erro desconhecido'));
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            alert('Erro ao realizar venda!');
        });
    }
}

// Event listeners
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('campoProduto').addEventListener('input', function(e) {
        buscarProduto(e.target.value);
    });
    
    document.getElementById('campoCliente').addEventListener('input', function(e) {
        buscarCliente(e.target.value);
    });
    
    // Fechar sugestões ao clicar fora
    document.addEventListener('click', function(e) {
        if (!e.target.closest('#sugestoesProduto') && !e.target.closest('#campoProduto')) {
            document.getElementById('sugestoesProduto').style.display = 'none';
        }
        if (!e.target.closest('#sugestoesCliente') && !e.target.closest('#campoCliente')) {
            document.getElementById('sugestoesCliente').style.display = 'none';
        }
    });
    
    // Inicializar tabela de produtos
    atualizarTabelaProdutos();
});
</script>
@endsection
