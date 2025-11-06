

<?php $__env->startSection('title', 'Relatório de Vendas'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Vendas Realizadas</h4>
                    <div class="btn-group">
                        <a href="javascript:void(0)" onclick="exportarPDF()" class="btn btn-light" title="Exportar PDF">
                            <i class="fas fa-file-pdf text-danger me-2"></i>PDF
                        </a>
                        <a href="javascript:void(0)" onclick="exportarExcel()" class="btn btn-light ms-2" title="Exportar Excel">
                            <i class="fas fa-file-excel text-success me-2"></i>Excel
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                                <tr>
                                <th>ID</th>
                                <th>Produto</th>
                                <th>Quantidade</th>
                                <th>Valor Unitário</th>
                                <th>Valor Total</th>
                                <th>Data</th>
                                    <th>Funcionário</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $vendas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $venda): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($venda->id); ?></td>
                                <td><?php echo e($venda->produto->nome); ?></td>
                                <td><?php echo e($venda->quantidade); ?></td>
                                <td>R$ <?php echo e(number_format($venda->produto->preco, 2, ',', '.')); ?></td>
                                <td>R$ <?php echo e(number_format($venda->preco_total, 2, ',', '.')); ?></td>
                                <td><?php echo e(optional($venda->created_at)->format('d/m/Y H:i')); ?></td>
                                <td><?php echo e(optional($venda->funcionario)->nome ?? '—'); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot>
                            <tr class="table-primary">
                                <td colspan="4" class="text-end"><strong>Total Geral:</strong></td>
                                <td colspan="3">
                                    <strong>R$ <?php echo e(number_format($vendas->sum('preco_total'), 2, ',', '.')); ?></strong>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Resumo do Período</h5>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Total de Vendas
                                        <span class="badge bg-primary rounded-pill"><?php echo e($vendas->count()); ?></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Média por Venda
                                        <span>R$ <?php echo e(number_format($vendas->avg('preco_total'), 2, ',', '.')); ?></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Maior Venda
                                        <span>R$ <?php echo e(number_format($vendas->max('preco_total'), 2, ',', '.')); ?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Filtros</h5>
                                <form action="<?php echo e(route('Relatorios.vendas')); ?>" method="GET">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="produto" class="form-label">Produto</label>
                                            <input type="text" class="form-control" id="produto" name="produto" value="<?php echo e(request('produto')); ?>" placeholder="Nome do produto">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="funcionario" class="form-label">Funcionário</label>
                                            <input type="text" class="form-control" id="funcionario" name="funcionario" value="<?php echo e(request('funcionario')); ?>" placeholder="Nome do funcionário">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="data_inicio" class="form-label">Data Início</label>
                                            <input type="date" class="form-control" id="data_inicio" name="data_inicio">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="data_fim" class="form-label">Data Fim</label>
                                            <input type="date" class="form-control" id="data_fim" name="data_fim">
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary w-100">
                                                <i class="fas fa-filter me-2"></i>Filtrar
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
function exportarPDF() {
    const dataInicio = document.getElementById('data_inicio').value;
    const dataFim = document.getElementById('data_fim').value;
    const produto = document.getElementById('produto') ? document.getElementById('produto').value : '';
    
    let url = '<?php echo e(route('Relatorios.vendas.pdf')); ?>';
    const params = new URLSearchParams();
    
    if (dataInicio) params.append('data_inicio', dataInicio);
    if (dataFim) params.append('data_fim', dataFim);
    if (produto) params.append('produto', produto);
    
    if (params.toString()) {
        url += '?' + params.toString();
    }
    
    window.location.href = url;
}

function exportarExcel() {
    const dataInicio = document.getElementById('data_inicio').value;
    const dataFim = document.getElementById('data_fim').value;
    const produto = document.getElementById('produto') ? document.getElementById('produto').value : '';

    let url = '<?php echo e(route('Relatorios.vendas.excel')); ?>';
    const params = new URLSearchParams();
    if (dataInicio) params.append('data_inicio', dataInicio);
    if (dataFim) params.append('data_fim', dataFim);
    if (produto) params.append('produto', produto);

    if (params.toString()) {
        url += '?' + params.toString();
    }

    window.location.href = url;
}

$(document).ready(function() {
    // Inicializar DataTables se necessário
    if ($.fn.DataTable) {
        $('.table').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json'
            }
        });
    }
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.financeiro', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Documents\GitHub\ProjetoBancoWeb\projetobanco\resources\views/Relatorios/vendas.blade.php ENDPATH**/ ?>