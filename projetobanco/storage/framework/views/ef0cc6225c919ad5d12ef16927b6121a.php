

<?php $__env->startSection('title', 'Gestão de Compras'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Nova Compra</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="<?php echo e(route('Compras.salvar')); ?>" id="formCompra">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label for="funcionario_id" class="form-label">Funcionário Responsável</label>
                        <select name="funcionario_id" id="funcionario_id" class="form-select" required>
                            <option value="">Selecione um Funcionário</option>
                            <?php if(isset($funcionarios)): ?>
                                <?php $__currentLoopData = $funcionarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($f->id); ?>"><?php echo e($f->nome); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="produto_id" class="form-label">Produto</label>
                        <select name="produto_id" id="produto_id" class="form-select" required>
                            <option value="">Selecione um Produto</option>
                            <?php $__currentLoopData = $produtos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($produto->id); ?>" data-preco="<?php echo e($produto->preco); ?>">
                                    <?php echo e($produto->nome); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                            value="<?php echo e(date('Y-m-d')); ?>">
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
                            <?php $__currentLoopData = $compras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $compra): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($compra->id); ?></td>
                                    <td><?php echo e($compra->produto->nome); ?></td>
                                    <td><?php echo e(optional($compra->funcionario)->nome ?? '—'); ?></td>
                                    <td><?php echo e($compra->quantidade); ?></td>
                                    <td>R$ <?php echo e(number_format($compra->preco_total, 2, ',', '.')); ?></td>
                                    <td><?php echo e(\Carbon\Carbon::parse($compra->data_compra)->format('d/m/Y')); ?></td>
                                    <td>
                                        <div class="table-actions">
                                            <a href="<?php echo e(route('Compras.editar', $compra->id)); ?>" 
                                                class="btn btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="<?php echo e(route('Compras.excluir', $compra->id)); ?>" 
                                                method="POST" style="display: inline-flex; align-items: center; margin: 0;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Deseja excluir esta compra?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.financeiro', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Documents\GitHub\ProjetoBancoWeb\projetobanco\resources\views/Compras/cadastro.blade.php ENDPATH**/ ?>