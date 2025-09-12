

<?php $__env->startSection('title', 'Cadastrar Cliente'); ?>

<?php $__env->startSection('page-title', 'Cadastro de Clientes'); ?>
<?php $__env->startSection('page-description', 'Gerencie o cadastro de clientes'); ?>

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

    <form action="<?php echo e(route('Clientes.Salvar')); ?>" method="POST" class="form">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label for="nome">Nome/Razão Social</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo e(old('nome')); ?>" maxlength="80" required>
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
            <input type="text" class="form-control" id="endereco" name="endereco" value="<?php echo e(old('endereco')); ?>" maxlength="100" required>
        </div>

        <button type="submit" class="btn btn-primary">Cadastrar Cliente</button>
    </form>

    <?php if(isset($clientes) && count($clientes) > 0): ?>
        <div class="table-responsive" style="margin-top: 2rem;">
            <h3 style="margin-bottom: 1rem;">Clientes Cadastrados</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>CPF/CNPJ</th>
                        <th>E-mail</th>
                        <th>Telefone</th>
                        <th>Endereço</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $clientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cliente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($cliente->nome); ?></td>
                            <td><?php echo e(\App\Helpers\FormatHelper::formatarDocumento($cliente->documento)); ?></td>
                            <td><?php echo e($cliente->email); ?></td>
                            <td><?php echo e(\App\Helpers\FormatHelper::formatarTelefone($cliente->telefone)); ?></td>
                            <td><?php echo e($cliente->endereco); ?></td>
                            <td style="display: flex; gap: 0.5rem;">
                                <a href="<?php echo e(route('Clientes.editar', $cliente->id)); ?>" class="btn btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="<?php echo e(route('Clientes.excluir', $cliente->id)); ?>" method="POST" style="display: inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este cliente?')">
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
    // Função para aplicar máscara de CPF/CNPJ
    function mascaraDocumento(valor) {
        valor = valor.replace(/\D/g, '');
        if (valor.length <= 11) {
            // CPF
            valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
            valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
            valor = valor.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
        } else {
            // CNPJ
            valor = valor.replace(/^(\d{2})(\d)/, '$1.$2');
            valor = valor.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
            valor = valor.replace(/\.(\d{3})(\d)/, '.$1/$2');
            valor = valor.replace(/(\d{4})(\d)/, '$1-$2');
        }
        return valor;
    }

    // Função para aplicar máscara de telefone
    function mascaraTelefone(valor) {
        valor = valor.replace(/\D/g, '');
        if (valor.length <= 11) {
            if (valor.length <= 10) {
                // Telefone fixo
                valor = valor.replace(/(\d{2})(\d)/, '($1) $2');
                valor = valor.replace(/(\d{4})(\d)/, '$1-$2');
            } else {
                // Celular
                valor = valor.replace(/(\d{2})(\d)/, '($1) $2');
                valor = valor.replace(/(\d{5})(\d)/, '$1-$2');
            }
        }
        return valor;
    }

    // Aplicar máscaras nos campos
    document.getElementById('documento').addEventListener('input', function(e) {
        e.target.value = mascaraDocumento(e.target.value);
    });

    document.getElementById('telefone').addEventListener('input', function(e) {
        e.target.value = mascaraTelefone(e.target.value);
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.financeiro', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Documents\GitHub\ProjetoBancoWeb\projetobanco\resources\views/Clientes/cadastro.blade.php ENDPATH**/ ?>