<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h2 class="mb-4 text-center fw-bold text-primary">📦 Localização de Produtos no Estoque</h2>

    <form action="<?php echo e(route('Localizacao.index')); ?>" method="GET" class="d-flex justify-content-center mb-4">
        <input type="text" name="busca"
            class="form-control w-50 me-2 shadow-sm"
            placeholder="🔍 Buscar por nome ou ID"
            value="<?php echo e(old('busca', $busca ?? '')); ?>">
        <button type="submit" class="btn btn-primary px-4">Buscar</button>
    </form>

    <?php if(isset($produtos) && $produtos->count() > 0): ?>
    <div class="table-responsive shadow-sm rounded-3">
        <table class="table table-striped table-hover align-middle text-center">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Localização</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $produtos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr <?php if(isset($busca) && (stripos($produto->nome, $busca) !== false || $produto->id == $busca)): ?>
                    class="table-info fw-bold"
                    <?php endif; ?>>
                    <td><?php echo e($produto->id); ?></td>
                    <td><?php echo e($produto->nome); ?></td>
                    <td><?php echo e($produto->localizacao ?? '-'); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <div class="mt-3 d-flex justify-content-center">
        <div class="d-flex align-items-center gap-2">
            <?php if($produtos->onFirstPage()): ?>
            <button class="btn btn-secondary" disabled>Anterior</button>
            <?php else: ?>
            <a href="<?php echo e($produtos->previousPageUrl()); ?>" class="btn btn-secondary">Anterior</a>
            <?php endif; ?>

            <span class="mx-3">Página <?php echo e($produtos->currentPage()); ?> de <?php echo e($produtos->lastPage()); ?></span>

            <?php if($produtos->hasMorePages()): ?>
            <a href="<?php echo e($produtos->nextPageUrl()); ?>" class="btn btn-primary">Próxima</a>
            <?php else: ?>
            <button class="btn btn-primary" disabled>Próxima</button>
            <?php endif; ?>
        </div>
    </div>
    <?php elseif(isset($busca)): ?>
    <div class="alert alert-warning text-center shadow-sm">
        Nenhum produto encontrado para "<strong><?php echo e($busca); ?></strong>".
    </div>
    <?php endif; ?>
</div>

<style>
    /* Estilos adicionais para refinar */
    body {
        background-color: #f8f9fa;
    }

    .table {
        border-radius: 0.75rem;
        overflow: hidden;
    }

    .table thead th {
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .table tbody tr:hover {
        background-color: #e9f3ff !important;
        transition: 0.2s;
    }

    input.form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        border-color: #86b7fe;
    }

    /* REMOVER SETAS DA PAGINAÇÃO - FORÇAR */
    .pagination li.page-item:first-child,
    .pagination li.page-item:last-child,
    .pagination .page-link[aria-label*="previous"],
    .pagination .page-link[aria-label*="next"],
    .pagination .page-link[rel="prev"],
    .pagination .page-link[rel="next"],
    .pagination .page-item.disabled .page-link[aria-label*="previous"],
    .pagination .page-item.disabled .page-link[aria-label*="next"],
    .pagination .page-item.disabled .page-link[aria-hidden="true"],
    nav .pagination li:first-child,
    nav .pagination li:last-child {
        display: none !important;
        visibility: hidden !important;
        opacity: 0 !important;
        width: 0 !important;
        height: 0 !important;
        padding: 0 !important;
        margin: 0 !important;
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.financeiro', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Documents\GitHub\ProjetoBancoWeb\projetobanco\resources\views/localizacao/index.blade.php ENDPATH**/ ?>