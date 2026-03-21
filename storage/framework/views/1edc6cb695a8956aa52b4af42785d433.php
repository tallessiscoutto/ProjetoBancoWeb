

<?php $__env->startSection('title', 'Editar Funcionário'); ?>

<?php $__env->startSection('page-title', 'Editar Funcionário'); ?>
<?php $__env->startSection('page-description', 'Atualize os dados do funcionário'); ?>

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

    <form action="<?php echo e(route('Funcionarios.atualizar', $funcionario->id)); ?>" method="POST" class="form">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        
        <div class="form-group">
            <label for="nome">Nome Completo</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo e(old('nome', $funcionario->nome)); ?>" maxlength="100" required>
        </div>

        <div class="form-group">
            <label for="documento">CPF/CNPJ</label>
            <input type="text" class="form-control" id="documento" name="documento" value="<?php echo e(old('documento', $funcionario->documento)); ?>" maxlength="18" required>
            <small class="form-text text-muted">Digite apenas números (11 dígitos para CPF ou 14 para CNPJ)</small>
        </div>

        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo e(old('email', $funcionario->email)); ?>" maxlength="100" required>
        </div>

        <div class="form-group">
            <label for="telefone">Telefone</label>
            <input type="tel" class="form-control" id="telefone" name="telefone" value="<?php echo e(old('telefone', $funcionario->telefone)); ?>" maxlength="15" required>
            <small class="form-text text-muted">Digite apenas números (DDD + número)</small>
        </div>

        <div class="form-group">
            <label for="cargo">Cargo</label>
            <input type="text" class="form-control" id="cargo" name="cargo" value="<?php echo e(old('cargo', $funcionario->cargo)); ?>" maxlength="50" required>
        </div>

        <div class="form-group">
            <label for="salario">Salário</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">R$</span>
                </div>
                <input type="text" class="form-control" id="salario" name="salario" value="<?php echo e(old('salario', number_format($funcionario->salario, 2, ',', '.'))); ?>" required>
            </div>
            <small class="form-text text-muted">Digite o valor sem pontos, usando vírgula para decimais (ex: 1234,56)</small>
        </div>

        <div style="display: flex; gap: 1rem;">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i>
                Atualizar Funcionário
            </button>
            
            <a href="<?php echo e(route('Funcionarios.cadastro')); ?>" class="btn btn-secondary">
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

    // Formatação do salário
    document.getElementById('salario').addEventListener('input', function (e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length > 0) {
            value = (parseFloat(value) / 100).toFixed(2);
            value = value.replace('.', ',');
            e.target.value = value;
        }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Documents\GitHub\ProjetoBancoWeb\projetobanco\resources\views/Funcionarios/editar.blade.php ENDPATH**/ ?>