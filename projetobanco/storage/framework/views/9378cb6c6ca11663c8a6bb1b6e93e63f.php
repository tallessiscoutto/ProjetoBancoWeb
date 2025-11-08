<?php $__env->startSection('title', 'Editar Produto'); ?>

<?php $__env->startSection('page-title', 'Editar Produto'); ?>
<?php $__env->startSection('page-description', 'Atualize as informações do produto'); ?>

<?php $__env->startSection('content'); ?>
    <form action="<?php echo e(route('Produtos.atualizar', $produto->id)); ?>" method="POST" class="form" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        
        <div class="form-group">
            <label for="nome">Nome do Produto</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo e($produto->nome); ?>" required>
        </div>

        <div class="form-group">
            <label for="marca">Marca</label>
            <input type="text" class="form-control" id="marca" name="marca" value="<?php echo e($produto->marca); ?>">
        </div>

        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao" rows="3" maxlength="255"><?php echo e($produto->descricao); ?></textarea>
        </div>

        <div class="form-group">
            <label for="foto">Foto do Produto</label>
            <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
            <small class="text-muted">Formatos: JPG, PNG, WEBP. Tamanho máx: 2MB.</small>
        </div>

        <?php if(!empty($produto->foto)): ?>
        <div class="mb-3">
            <label class="form-label d-block">Foto atual</label>
            <img src="<?php echo e(asset('storage/' . $produto->foto)); ?>" alt="<?php echo e($produto->nome); ?>" style="width:96px;height:96px;object-fit:cover;border-radius:8px;border:1px solid #eee;">
        </div>
        <?php endif; ?>

        <div class="form-group">
            <label for="preco">Preço</label>
            <input type="number" class="form-control" id="preco" name="preco" step="0.01" value="<?php echo e($produto->preco); ?>" required>
        </div>

        <div class="form-group">
            <label for="quantidade">Quantidade em Estoque</label>
            <input type="number" class="form-control" id="quantidade" name="quantidade" value="<?php echo e($produto->quantidade); ?>" required>
        </div>
        <div class="mb-3">
            <label for="localizacao" class="form-label">Localização (Ex: Estante A / Prateleira 3)</label>
            <input type="text" name="localizacao" id="localizacao" class="form-control" value="<?php echo e($produto->localizacao); ?>">
        </div>

        <div class="form-group">
            <label for="fornecedor_id">Fornecedor</label>
            <select class="form-control" id="fornecedor_id" name="fornecedor_id" required>
                <option value="">Selecione um fornecedor</option>
                <?php $__currentLoopData = $fornecedores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fornecedor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($fornecedor->id); ?>" <?php echo e($produto->fornecedor_id == $fornecedor->id ? 'selected' : ''); ?>>
                        <?php echo e($fornecedor->nome); ?>

                    </option>
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
                Atualizar Produto
            </button>
            
            <a href="<?php echo e(route('Produtos.cadastro')); ?>" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i>
                Voltar
            </a>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Documents\GitHub\ProjetoBancoWeb\projetobanco\resources\views/Produtos/editar.blade.php ENDPATH**/ ?>