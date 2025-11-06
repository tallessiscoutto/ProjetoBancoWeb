

<?php $__env->startSection('title', 'Cadastrar Funcionário'); ?>

<?php $__env->startSection('page-title', 'Cadastro de Funcionários'); ?>
<?php $__env->startSection('page-description', 'Gerencie o cadastro de funcionários'); ?>

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

    <form action="<?php echo e(route('Funcionarios.salvar')); ?>" method="POST" class="form">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label for="nome">Nome Completo</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo e(old('nome')); ?>" maxlength="100" required>
        </div>

        <div class="form-group">
            <label for="documento">CPF/CNPJ</label>
            <input type="text" class="form-control" id="documento" name="documento" value="<?php echo e(old('documento')); ?>" maxlength="18" required>
            <small class="form-text text-muted">Digite apenas números (11 dígitos para CPF ou 14 para CNPJ)</small>
        </div>

        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo e(old('email')); ?>" maxlength="100" required>
        </div>

        <div class="form-group">
            <label for="telefone">Telefone</label>
            <input type="text" class="form-control" id="telefone" name="telefone" value="<?php echo e(old('telefone')); ?>" maxlength="15" required>
            <small class="form-text text-muted">Digite apenas números (10 ou 11 dígitos)</small>
        </div>

        <div class="form-group">
            <label for="endereco">Endereço</label>
            <input type="text" class="form-control" id="endereco" name="endereco" required>
        </div>

        <div class="form-group">
            <label for="cargo">Cargo</label>
            <input type="text" class="form-control" id="cargo" name="cargo" value="<?php echo e(old('cargo')); ?>" maxlength="50" required>
        </div>

        <div class="form-group">
            <label for="salario">Salário</label>
            <input type="text" class="form-control" id="salario" name="salario" value="<?php echo e(old('salario')); ?>" required>
            <small class="form-text text-muted">Digite o valor sem pontos ou vírgulas</small>
        </div>

        <div class="form-group">
            <label for="data_admissao">Data de Admissão</label>
            <input type="date" class="form-control" id="data_admissao" name="data_admissao" required>
        </div>

        <div style="display: flex; gap: 1rem;">
            <button type="submit" class="btn btn-primary">Cadastrar Funcionário</button>
            
            <a href="<?php echo e(route('home')); ?>" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i>
                Voltar
            </a>
        </div>
    </form>

    <?php if(isset($funcionarios) && count($funcionarios) > 0): ?>
        <div class="table-responsive" style="margin-top: 2rem;">
            <h3 style="margin-bottom: 1rem;">Funcionários Cadastrados</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>CPF/CNPJ</th>
                        <th>E-mail</th>
                        <th>Telefone</th>
                        <th>Cargo</th>
                        <th>Salário</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $funcionarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $funcionario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($funcionario->nome); ?></td>
                            <td><?php echo e(\App\Helpers\FormatHelper::formatarDocumento($funcionario->documento)); ?></td>
                            <td><?php echo e($funcionario->email); ?></td>
                            <td><?php echo e(\App\Helpers\FormatHelper::formatarTelefone($funcionario->telefone)); ?></td>
                            <td><?php echo e($funcionario->cargo); ?></td>
                            <td>R$ <?php echo e(number_format($funcionario->salario, 2, ',', '.')); ?></td>
                            <td style="display: flex; gap: 0.5rem;">
                                <a href="<?php echo e(route('Funcionarios.editar', $funcionario->id)); ?>" class="btn btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="<?php echo e(route('Funcionarios.excluir', $funcionario->id)); ?>" method="POST" style="display: inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este funcionário?')">
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
<?php echo $__env->make('layouts.financeiro', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Documents\GitHub\ProjetoBancoWeb\projetobanco\resources\views/Funcionarios/cadastro.blade.php ENDPATH**/ ?>