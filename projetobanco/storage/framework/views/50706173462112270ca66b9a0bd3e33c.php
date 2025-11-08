

<?php $__env->startSection('title','Reservas'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><h4 class="mb-0">Nova Reserva</h4></div>
            <div class="card-body">
                <form method="POST" action="<?php echo e(route('Reservas.salvar')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label class="form-label" for="cliente_id">Cliente</label>
                        <select class="form-select" id="cliente_id" name="cliente_id" required>
                            <option value="">Selecione</option>
                            <?php $__currentLoopData = $clientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($c->id); ?>" <?php echo e((int)old('cliente_id', $clienteSelecionadoId ?? request('cliente_id')) === $c->id ? 'selected' : ''); ?>><?php echo e($c->nome); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="produto_id">Produto</label>
                        <select class="form-select" id="produto_id" name="produto_id" required>
                            <option value="">Selecione</option>
                            <?php $__currentLoopData = $produtos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($p->id); ?>" <?php echo e((int)old('produto_id', $produtoSelecionadoId ?? request('produto_id')) === $p->id ? 'selected' : ''); ?>>#<?php echo e($p->id); ?> · <?php echo e($p->nome); ?> (Estoque: <?php echo e($p->quantidade); ?>)</option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="quantidade">Quantidade</label>
                        <input class="form-control" type="number" id="quantidade" name="quantidade" min="1" value="<?php echo e(old('quantidade', $quantidadeSugerida ?? request('quantidade') ?? 1)); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="data_validade">Validade</label>
                        <input class="form-control" type="date" id="data_validade" name="data_validade" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-save me-2"></i>Reservar</button>
                </form>
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger mt-3">
                        <ul class="mb-0">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Reservas</h4>
                    <form class="row g-2" method="GET" action="<?php echo e(route('Reservas.cadastro')); ?>">
                        <div class="col-auto">
                            <input type="text" class="form-control" name="cliente" placeholder="Cliente" value="<?php echo e(request('cliente')); ?>">
                        </div>
                        <div class="col-auto">
                            <input type="text" class="form-control" name="produto" placeholder="Produto" value="<?php echo e(request('produto')); ?>">
                        </div>
                        <div class="col-auto">
                            <select name="status" class="form-select">
                                <option value="">Status</option>
                                <option value="ativa" <?php echo e(request('status')==='ativa' ? 'selected' : ''); ?>>Ativa</option>
                                <option value="concluida" <?php echo e(request('status')==='concluida' ? 'selected' : ''); ?>>Concluída</option>
                                <option value="cancelada" <?php echo e(request('status')==='cancelada' ? 'selected' : ''); ?>>Cancelada</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <input type="date" class="form-control" name="inicio" value="<?php echo e(request('inicio')); ?>">
                        </div>
                        <div class="col-auto">
                            <input type="date" class="form-control" name="fim" value="<?php echo e(request('fim')); ?>">
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
                            <?php $__empty_1 = true; $__currentLoopData = $reservas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($r->id); ?></td>
                                <td><?php echo e($r->cliente->nome); ?></td>
                                <td><?php echo e($r->produto->nome); ?></td>
                                <td><?php echo e($r->quantidade); ?></td>
                                <td><?php echo e(\Carbon\Carbon::parse($r->data_validade)->format('d/m/Y')); ?></td>
                                <td>
                                    <?php if($r->status === 'ativa'): ?>
                                        <span class="badge bg-info">Ativa</span>
                                    <?php elseif($r->status === 'concluida'): ?>
                                        <span class="badge bg-success">Concluída</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Cancelada</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <form method="POST" action="<?php echo e(route('Reservas.concluir', $r->id)); ?>" style="display: inline;">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="btn btn-success" <?php echo e($r->status!=='ativa' ? 'disabled' : ''); ?>>
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                        <form method="POST" action="<?php echo e(route('Reservas.cancelar', $r->id)); ?>" style="display: inline;">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="btn btn-danger" <?php echo e($r->status!=='ativa' ? 'disabled' : ''); ?>>
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr><td colspan="7" class="text-center text-muted">Nenhuma reserva registrada</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <?php echo e($reservas->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.financeiro', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Documents\GitHub\ProjetoBancoWeb\projetobanco\resources\views/Reservas/cadastro.blade.php ENDPATH**/ ?>