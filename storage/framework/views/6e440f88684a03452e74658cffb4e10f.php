<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title'); ?> - Sistema Bancário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/financeiro.css')); ?>">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --success-color: #27ae60;
            --danger-color: #e74c3c;
            --warning-color: #f1c40f;
            --info-color: #3498db;
            --sidebar-width: 250px;
            --text-color: #202124;
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--primary-color), #34495e);
            padding: 1rem;
            color: white;
            overflow-y: auto;
            z-index: 1000;
            margin-right: 2rem;
        }

        .sidebar-header {
            padding: 1rem;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 1rem;
        }

        .sidebar-header h1 {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }

        .nav-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav-item {
            margin-bottom: 0.5rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.8rem 1rem;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
            color: white;
            text-decoration: none;
        }

        .logout-btn {
            position: absolute;
            bottom: 1rem;
            left: 1rem;
            right: 1rem;
            padding: 0.8rem;
            background: rgba(231, 76, 60, 0.9);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: background 0.3s ease;
        }

        .logout-btn i {
            margin-right: 8px;
        }

        .logout-btn:hover {
            background: #c0392b;
        }

        html,
        body {
            overflow-x: hidden;
            width: 100%;
            max-width: 100%;
        }

        body {
            margin-left: calc(var(--sidebar-width) + 2rem);
            background-color: #f8f9fa;
            color: var(--text-color);
            font-family: 'Roboto', sans-serif;
            width: calc(100% - var(--sidebar-width) - 2rem) !important;
            max-width: calc(100% - var(--sidebar-width) - 2rem) !important;
            box-sizing: border-box;
            overflow-x: hidden !important;
        }

        .container {
            margin-left: 0 !important;
            width: 100% !important;
            max-width: 100% !important;
            box-sizing: border-box !important;
            overflow-x: hidden !important;
            padding-left: 3rem !important;
            padding-right: 3rem !important;
        }

        .container>* {
            max-width: 100% !important;
            box-sizing: border-box !important;
        }

        .menu-toggle {
            display: none;
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 1001;
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 0.8rem 1rem;
            border-radius: 8px;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                z-index: 1000;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            body {
                margin-left: 0 !important;
            }

            .container {
                width: 100%;
                max-width: 100%;
                padding-left: 2rem !important;
                padding-right: 2rem !important;
            }

            .menu-toggle {
                display: block;
            }

            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 999;
            }

            .sidebar-overlay.active {
                display: block;
            }

            .modal {
                z-index: 1055 !important;
            }

            .modal-backdrop {
                z-index: 1050 !important;
            }
        }

        @media (max-width: 992px) {
            .container {
                padding-left: 2rem !important;
                padding-right: 2rem !important;
            }
        }

        @media (max-width: 576px) {
            .container {
                padding-left: 1rem !important;
                padding-right: 1rem !important;
            }
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            border: none;
        }

        .card-header {
            background-color: var(--primary-color);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 15px 20px;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #1557b0;
            transform: translateY(-2px);
        }

        .btn-success {
            background-color: var(--accent-color);
            border: none;
        }

        .btn-danger {
            background-color: var(--danger-color);
            border: none;
        }

        .table {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
        }

        .table thead th {
            background-color: var(--primary-color);
            color: white;
            border: none;
        }

        .table td {
            vertical-align: middle;
        }

        .table-actions {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            white-space: nowrap;
        }

        .table-actions .btn,
        .table-actions form {
            margin: 0;
            padding: 0;
            display: inline-flex;
            align-items: center;
            vertical-align: middle;
        }

        .table-actions .btn {
            padding: 0.4rem 0.8rem;
        }

        .table-actions form .btn {
            padding: 0.4rem 0.8rem;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 10px 15px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(26, 115, 232, 0.25);
        }

        .alert {
            border-radius: 10px;
            border: none;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        .page-header {
            margin-bottom: 30px;
            padding: 20px 0;
            border-bottom: 2px solid var(--primary-color);
        }

        .icon-button {
            padding: 8px;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .icon-button:hover {
            transform: scale(1.1);
        }

        .money-input::before {
            content: "R$ ";
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
        }

        .status-badge {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.85em;
            font-weight: 500;
        }

        /* Correção dos botões de paginação */
        .pagination {
            margin: 0;
            padding: 0;
            display: flex;
            list-style: none;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
        }

        .pagination .page-item {
            margin: 0 2px;
        }

        .pagination .page-link {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            text-align: center;
            min-width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .pagination .page-link:focus {
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        /* REMOVER COMPLETAMENTE AS SETAS DA PAGINAÇÃO - MÁXIMA ESPECIFICIDADE */
        nav ul.pagination li.page-item:first-child,
        nav ul.pagination li.page-item:last-child,
        nav ul.pagination li.page-item a.page-link[aria-label*="previous"],
        nav ul.pagination li.page-item a.page-link[aria-label*="next"],
        nav ul.pagination li.page-item a.page-link[rel="prev"],
        nav ul.pagination li.page-item a.page-link[rel="next"],
        nav ul.pagination li.page-item.disabled span.page-link[aria-label*="previous"],
        nav ul.pagination li.page-item.disabled span.page-link[aria-label*="next"],
        nav ul.pagination li.page-item.disabled span.page-link[aria-hidden="true"],
        .pagination li.page-item:first-child,
        .pagination li.page-item:last-child,
        .pagination .page-link[aria-label*="previous"],
        .pagination .page-link[aria-label*="next"],
        .pagination .page-link[rel="prev"],
        .pagination .page-link[rel="next"] {
            display: none !important;
            visibility: hidden !important;
            opacity: 0 !important;
            width: 0 !important;
            height: 0 !important;
            padding: 0 !important;
            margin: 0 !important;
            overflow: hidden !important;
        }

        .pagination .page-item.disabled .page-link {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .pagination .page-item.active .page-link {
            z-index: 3;
        }

        /* Ajustar para mobile */
        @media (max-width: 576px) {
            .pagination {
                justify-content: center;
            }
            
            .pagination .page-item {
                margin: 2px;
            }
            
            .pagination .page-link {
                padding: 0.25rem 0.5rem;
                font-size: 0.8rem;
                min-width: 32px;
                height: 32px;
            }
        }
    </style>
</head>

<body>
    <button class="menu-toggle" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>

    <div class="sidebar-overlay" onclick="toggleSidebar()"></div>

    <?php echo $__env->make('components.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="container py-4">
        <div class="page-header">
            <h1 class="text-center"><?php echo $__env->yieldContent('title'); ?></h1>
        </div>

        <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>

    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.querySelector('.sidebar-overlay');
            if (sidebar) {
                sidebar.classList.toggle('active');
            }
            if (overlay) {
                overlay.classList.toggle('active');
            }
        }

        // Fechar sidebar ao clicar em um link (mobile)
        document.addEventListener('DOMContentLoaded', function() {
            if (window.innerWidth <= 768) {
                const navLinks = document.querySelectorAll('.sidebar .nav-link');
                navLinks.forEach(link => {
                    link.addEventListener('click', function() {
                        toggleSidebar();
                    });
                });
            }

            // REMOVER SETAS DA PAGINAÇÃO - FORÇA BRUTA
            function removerSetasPagina() {
                // Remover primeiro e último item de todas as listas de paginação
                document.querySelectorAll('.pagination').forEach(function(pagination) {
                    const items = pagination.querySelectorAll('li.page-item');
                    if (items.length > 0) {
                        // Remove primeiro item
                        if (items[0]) {
                            items[0].remove();
                        }
                        // Remove último item (se ainda existir)
                        const remainingItems = pagination.querySelectorAll('li.page-item');
                        if (remainingItems.length > 0) {
                            remainingItems[remainingItems.length - 1].remove();
                        }
                    }
                });

                // Remover também por atributos
                document.querySelectorAll('.page-link[aria-label*="previous"], .page-link[aria-label*="next"], .page-link[rel="prev"], .page-link[rel="next"]').forEach(function(el) {
                    el.closest('li.page-item')?.remove();
                });
            }

            // Executar imediatamente
            removerSetasPagina();

            // Executar após um pequeno delay para garantir que o DOM está completo
            setTimeout(removerSetasPagina, 100);
            setTimeout(removerSetasPagina, 500);

            // Observar mudanças no DOM
            const observer = new MutationObserver(function(mutations) {
                removerSetasPagina();
            });
            observer.observe(document.body, { childList: true, subtree: true });
        });
    </script>

    <?php echo $__env->yieldContent('scripts'); ?>
</body>

</html><?php /**PATH C:\Users\User\Documents\GitHub\ProjetoBancoWeb\projetobanco\resources\views/layouts/financeiro.blade.php ENDPATH**/ ?>