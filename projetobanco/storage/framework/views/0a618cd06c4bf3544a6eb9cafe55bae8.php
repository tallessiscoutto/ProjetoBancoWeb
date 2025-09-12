

<?php $__env->startSection('title', 'Realizar Venda'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <!-- Coluna da esquerda - Busca de produtos -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Buscar Produto</h4>
            </div>
            <div class="card-body">
                <form id="buscarProdutoForm" class="mb-4">
                    <?php echo csrf_field(); ?>
                    <div class="row align-items-end">
                        <div class="col-md-8">
                            <label for="produto_id" class="form-label">ID do Produto</label>
                            <input type="number" name="produto_id" id="produto_id" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-search me-2"></i>Buscar
                            </button>
                        </div>
                    </div>
                </form>

                <div id="produtoEncontrado" style="display: none;">
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">Produto Encontrado</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto" style="width: 100px; height: 100px">
                                        <i class="fas fa-box fa-2x text-primary"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h5 id="produtoNome"></h5>
                                    <p class="mb-1"><strong>Marca:</strong> <span id="produtoMarca"></span></p>
                                    <p class="mb-1"><strong>Preço:</strong> R$ <span id="produtoPreco"></span></p>
                                    <p class="mb-3"><strong>Estoque:</strong> 
                                        <span class="badge bg-info" id="produtoEstoque"></span>
                                    </p>

                                    <div class="row align-items-end">
                                        <div class="col-md-6">
                                            <label for="quantidade" class="form-label">Quantidade</label>
                                            <input type="number" id="quantidade" class="form-control" min="1" value="1">
                                        </div>
                                        <div class="col-md-6">
                                            <button type="button" id="adicionarProduto" class="btn btn-success w-100">
                                                <i class="fas fa-plus me-2"></i>Adicionar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Coluna da direita - Carrinho de compras -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Carrinho de Venda</h4>
            </div>
            <div class="card-body">
                <div id="carrinhoVazio" class="text-center py-4">
                    <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Nenhum produto adicionado ao carrinho</p>
                </div>

                <div id="carrinhoComProdutos" style="display: none;">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Produto</th>
                                    <th>Qtd</th>
                                    <th>Preço</th>
                                    <th>Total</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody id="tabelaCarrinho">
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <h5>Total da Venda: <span id="totalVenda" class="text-success">R$ 0,00</span></h5>
                        </div>
                        <div class="col-md-6 text-end">
                            <button type="button" id="finalizarVenda" class="btn btn-success btn-lg">
                                <i class="fas fa-check-circle me-2"></i>Finalizar Venda
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
// Variáveis globais
let carrinho = [];
let produtoAtual = null;

// Função para formatar moeda
function formatarMoeda(valor) {
    return valor.toLocaleString('pt-BR', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });
}

// Função para buscar produto via AJAX
function buscarProduto(produtoId) {
    fetch('<?php echo e(route("Vendas.buscar")); ?>', {
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
            // Armazenar dados do produto
            produtoAtual = {
                id: data.produto.id,
                nome: data.produto.nome,
                marca: data.produto.marca,
                preco: parseFloat(data.produto.preco),
                estoque: parseInt(data.produto.quantidade)
            };
            
            // Mostrar produto encontrado
            document.getElementById('produtoNome').textContent = produtoAtual.nome;
            document.getElementById('produtoMarca').textContent = produtoAtual.marca;
            document.getElementById('produtoPreco').textContent = formatarMoeda(produtoAtual.preco);
            document.getElementById('produtoEstoque').textContent = produtoAtual.estoque + ' unidades';
            document.getElementById('produtoEncontrado').style.display = 'block';
            
            // Limpar campo de busca
            document.getElementById('produto_id').value = '';
        } else {
            alert('Produto não encontrado!');
        }
    })
    .catch(error => {
        console.error('Erro:', error);
        alert('Erro ao buscar produto!');
    });
}

// Função para adicionar produto ao carrinho
function adicionarAoCarrinho() {
    if (!produtoAtual) return;
    
    const quantidade = parseInt(document.getElementById('quantidade').value);
    
    if (quantidade < 1) {
        alert('Quantidade deve ser maior que zero!');
        return;
    }
    
    if (quantidade > produtoAtual.estoque) {
        alert('Quantidade maior que o estoque disponível!');
        return;
    }
    
    // Verificar se o produto já está no carrinho
    const produtoExistente = carrinho.find(item => item.id === produtoAtual.id);
    
    if (produtoExistente) {
        // Atualizar quantidade se produto já existe
        produtoExistente.quantidade += quantidade;
        produtoExistente.total = produtoExistente.quantidade * produtoExistente.preco;
    } else {
        // Adicionar novo produto ao carrinho
        carrinho.push({
            id: produtoAtual.id,
            nome: produtoAtual.nome,
            marca: produtoAtual.marca,
            preco: produtoAtual.preco,
            quantidade: quantidade,
            total: quantidade * produtoAtual.preco
        });
    }
    
    atualizarCarrinho();
    
    // Ocultar produto encontrado
    document.getElementById('produtoEncontrado').style.display = 'none';
    produtoAtual = null;
}

// Função para remover produto do carrinho
function removerDoCarrinho(produtoId) {
    carrinho = carrinho.filter(item => item.id !== produtoId);
    atualizarCarrinho();
}

// Função para atualizar a exibição do carrinho
function atualizarCarrinho() {
    const tbody = document.getElementById('tabelaCarrinho');
    const carrinhoVazio = document.getElementById('carrinhoVazio');
    const carrinhoComProdutos = document.getElementById('carrinhoComProdutos');
    
    if (carrinho.length === 0) {
        carrinhoVazio.style.display = 'block';
        carrinhoComProdutos.style.display = 'none';
        return;
    }
    
    carrinhoVazio.style.display = 'none';
    carrinhoComProdutos.style.display = 'block';
    
    // Limpar tabela
    tbody.innerHTML = '';
    
    // Adicionar produtos à tabela
    carrinho.forEach(item => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>
                <strong>${item.nome}</strong><br>
                <small class="text-muted">${item.marca}</small>
            </td>
            <td>${item.quantidade}</td>
            <td>R$ ${formatarMoeda(item.preco)}</td>
            <td>R$ ${formatarMoeda(item.total)}</td>
            <td>
                <button type="button" class="btn btn-danger btn-sm" onclick="removerDoCarrinho(${item.id})">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        `;
        tbody.appendChild(row);
    });
    
    // Calcular e exibir total
    const totalVenda = carrinho.reduce((total, item) => total + item.total, 0);
    document.getElementById('totalVenda').textContent = `R$ ${formatarMoeda(totalVenda)}`;
}

// Função para finalizar venda
function finalizarVenda() {
    if (carrinho.length === 0) {
        alert('Adicione pelo menos um produto ao carrinho!');
        return;
    }
    
    if (confirm('Deseja finalizar esta venda?')) {
        // Preparar dados para envio
        const dadosVenda = carrinho.map(item => ({
            produto_id: item.id,
            quantidade: item.quantidade,
            preco_total: item.total
        }));
        
        // Enviar dados via AJAX
        fetch('<?php echo e(route("Vendas.salvar")); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ produtos: dadosVenda })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Venda realizada com sucesso!');
                // Limpar carrinho
                carrinho = [];
                atualizarCarrinho();
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
$(document).ready(function() {
    // Buscar produto
    document.getElementById('buscarProdutoForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const produtoId = document.getElementById('produto_id').value;
        if (produtoId) {
            buscarProduto(produtoId);
        }
    });
    
    // Adicionar produto ao carrinho
    document.getElementById('adicionarProduto').addEventListener('click', adicionarAoCarrinho);
    
    // Finalizar venda
    document.getElementById('finalizarVenda').addEventListener('click', finalizarVenda);
    
    // Permitir adicionar produto com Enter
    document.getElementById('quantidade').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            adicionarAoCarrinho();
        }
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.financeiro', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Documents\GitHub\ProjetoBancoWeb\projetobanco\resources\views/Vendas/cadastro.blade.php ENDPATH**/ ?>