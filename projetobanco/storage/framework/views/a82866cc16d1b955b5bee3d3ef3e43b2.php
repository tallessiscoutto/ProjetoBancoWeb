<?php $__env->startSection('title', 'Visualizar Produtos'); ?>

<?php $__env->startSection('page-title', 'Produtos'); ?>
<?php $__env->startSection('page-description', 'Consulte e filtre produtos do catálogo'); ?>

<?php $__env->startSection('content'); ?>
<form method="GET" action="<?php echo e(route('Produtos.visualizar')); ?>" class="mb-3">
    <div class="input-group">
        <input type="text" class="form-control" name="q" value="<?php echo e($busca); ?>" placeholder="Buscar por nome, descrição ou código">
        <button class="btn btn-primary" type="submit"><i class="fas fa-search me-2"></i>Buscar</button>
    </div>
    <?php if($busca): ?>
        <small class="text-muted">Mostrando resultados para: <strong><?php echo e($busca); ?></strong></small>
    <?php endif; ?>
    <a class="btn btn-link" href="<?php echo e(route('Produtos.cadastro')); ?>">Cadastrar novo</a>
</form>

<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Código</th>
                <th>Foto</th>
                <th>Marca</th>
                <th>Nome</th>
                <th>Fornecedor</th>
                <th>Preço</th>
                <th>Estoque</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $produtos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td>#<?php echo e($p->id); ?></td>
                <td>
                    <?php if($p->foto): ?>
                        <img src="<?php echo e(asset('storage/'.$p->foto)); ?>" alt="<?php echo e($p->nome); ?>" style="width:40px;height:40px;object-fit:cover;border-radius:6px;">
                    <?php else: ?>
                        <span class="text-muted">—</span>
                    <?php endif; ?>
                </td>
                <td><?php echo e($p->marca ?? '—'); ?></td>
                <td><?php echo e($p->nome); ?></td>
                <td><?php echo e(optional($p->fornecedor)->nome); ?></td>
                <td>R$ <?php echo e(number_format($p->preco, 2, ',', '.')); ?></td>
                <td><?php echo e($p->quantidade); ?></td>
                <td class="text-end">
                    <a class="btn btn-sm btn-primary" href="<?php echo e(route('Produtos.editar', $p->id)); ?>"><i class="fas fa-edit"></i></a>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="7" class="text-center text-muted">Nenhum produto encontrado</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php echo e($produtos->links()); ?>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Documents\GitHub\ProjetoBancoWeb\projetobanco\resources\views/Produtos/visualizar.blade.php ENDPATH**/ ?>