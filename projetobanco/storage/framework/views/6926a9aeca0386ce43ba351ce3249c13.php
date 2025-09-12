

<?php $__env->startSection('title', 'Cadastro de Produtos'); ?>

<?php $__env->startSection('page-title', 'Cadastro de Produtos'); ?>
<?php $__env->startSection('page-description', 'Adicione novos produtos ao catálogo'); ?>

<?php $__env->startSection('content'); ?>
<form action="<?php echo e(route('Produtos.salvar')); ?>" method="POST" class="form">
    <?php echo csrf_field(); ?>
    <div class="form-group">
        <label for="nome">Nome do Produto</label>
        <input type="text" class="form-control" id="nome" name="nome" required>
    </div>

    <div class="form-group">
        <label for="descricao">Descrição</label>
        <textarea class="form-control" id="descricao" name="descricao" rows="3"></textarea>
    </div>
    <div class="form-group">
        <label for="preco">Preço</label>
        <input type="number" class="form-control" id="preco" name="preco" step="0.01" required>
    </div>

    <div class="form-group">
        <label for="quantidade">Quantidade em Estoque</label>
        <input type="number" class="form-control" id="quantidade" name="quantidade" required>
    </div>

    <div class="form-group">
        <label for="fornecedor_id">Fornecedor</label>
        <select class="form-control" id="fornecedor_id" name="fornecedor_id" required>
            <option value="">Selecione um fornecedor</option>
            <?php $__currentLoopData = $fornecedores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fornecedor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($fornecedor->id); ?>"><?php echo e($fornecedor->nome); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <div style="display: flex; gap: 1rem;">
        <button type="submit" class="btn btn-success">
            <i class="fas fa-save"></i>
            Salvar Produto
        </button>

        <a href="<?php echo e(route('home')); ?>" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i>
            Voltar
        </a>
    </div>
</form>

<?php if(isset($produtos) && count($produtos) > 0): ?>
<div class="table-responsive" style="margin-top: 2rem;">
    <h3 style="margin-bottom: 1rem;">Produtos Cadastrados</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Fornecedor</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $produtos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($produto->nome); ?></td>
                <td>R$ <?php echo e(number_format($produto->preco, 2, ',', '.')); ?></td>
                <td><?php echo e($produto->quantidade); ?></td>
                <td><?php echo e($produto->fornecedor->nome); ?></td>
                <td style="display: flex; gap: 0.5rem;">
                    <a href="<?php echo e(route('Produtos.editar', $produto->id)); ?>" class="btn btn-primary">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="<?php echo e(route('Produtos.excluir', $produto->id)); ?>" method="POST" style="display: inline;">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Tem certeza que deseja excluir este produto?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Documents\GitHub\ProjetoBancoWeb\projetobanco\resources\views/Produtos/cadastro.blade.php ENDPATH**/ ?>