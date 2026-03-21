

<?php $__env->startSection('title', 'Editar Fornecedor'); ?>

<?php $__env->startSection('page-title', 'Editar Fornecedor'); ?>
<?php $__env->startSection('page-description', 'Atualize os dados do fornecedor'); ?>

<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('Fornecedores.atualizar', $fornecedor->id)); ?>" method="POST" class="form">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        
        <div class="form-group">
            <label for="nome">Nome/Razão Social</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo e(old('nome', $fornecedor->nome)); ?>" maxlength="80" required>
        </div>

        <div class="form-group">
            <label for="documento">CPF/CNPJ</label>
            <input type="text" class="form-control" id="documento" name="documento" value="<?php echo e(old('documento', $fornecedor->documento)); ?>" maxlength="18" required>
            <small class="form-text text-muted">Digite apenas números (11 dígitos para CPF ou 14 para CNPJ)</small>
        </div>

        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo e(old('email', $fornecedor->email)); ?>" maxlength="100" required>
        </div>

        <div class="form-group">
            <label for="telefone">Telefone</label>
            <input type="tel" class="form-control" id="telefone" name="telefone" value="<?php echo e(old('telefone', $fornecedor->telefone)); ?>" maxlength="15" required>
            <small class="form-text text-muted">Digite apenas números (DDD + número)</small>
        </div>

        <div class="form-group">
            <label for="endereco">Endereço</label>
            <input type="text" class="form-control" id="endereco" name="endereco" value="<?php echo e(old('endereco', $fornecedor->endereco)); ?>" maxlength="100" required>
        </div>

        <div class="form-group">
            <label for="produtos_disponiveis">Produtos Disponíveis</label>
            <textarea class="form-control" id="produtos_disponiveis" name="produtos_disponiveis" rows="3" required><?php echo e(old('produtos_disponiveis', $fornecedor->produtos_disponiveis)); ?></textarea>
            <small class="form-text text-muted">Liste os produtos separados por vírgula ou nova linha</small>
        </div>

        <div class="form-group">
            <label for="formas_pagamento">Formas de Pagamento</label>
            <textarea class="form-control" id="formas_pagamento" name="formas_pagamento" rows="3" required><?php echo e(old('formas_pagamento', $fornecedor->formas_pagamento)); ?></textarea>
            <small class="form-text text-muted">Liste as formas de pagamento separadas por vírgula ou nova linha</small>
        </div>

        <div style="display: flex; gap: 1rem;">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i>
                Atualizar Fornecedor
            </button>
            
            <a href="<?php echo e(route('Fornecedores.cadastro')); ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i>
                Voltar
            </a>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    // Máscara para CPF/CNPJ
    document.getElementById('documento').addEventListener('input', function (e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length <= 11) {
            // CPF
            value = value.replace(/(\d{3})(\d)/, '$1.$2');
            value = value.replace(/(\d{3})(\d)/, '$1.$2');
            value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
        } else {
            // CNPJ
            value = value.replace(/^(\d{2})(\d)/, '$1.$2');
            value = value.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
            value = value.replace(/\.(\d{3})(\d)/, '.$1/$2');
            value = value.replace(/(\d{4})(\d)/, '$1-$2');
        }
        e.target.value = value;
    });

    // Máscara para telefone
    document.getElementById('telefone').addEventListener('input', function (e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length <= 11) {
            if (value.length === 11) {
                // Celular
                value = value.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
            } else {
                // Telefone fixo
                value = value.replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
            }
            e.target.value = value;
        }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Documents\GitHub\ProjetoBancoWeb\projetobanco\resources\views/Fornecedores/editar.blade.php ENDPATH**/ ?>