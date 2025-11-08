<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title'); ?> - Perfumes da Chiquinha</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    :root {
        --primary-color: #2c3e50;
        --secondary-color: #3498db;
        --success-color: #27ae60;
        --danger-color: #e74c3c;
        --warning-color: #f1c40f;
        --info-color: #3498db;
        --sidebar-width: 250px;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }
    
    html {
        overflow-x: hidden;
        width: 100%;
        max-width: 100%;
    }

    body {
        background-color: #f5f6fa;
        min-height: 100vh;
        overflow-x: hidden !important;
        width: 100%;
        max-width: 100%;
        position: relative;
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
        overflow-x: hidden;
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

    .user-info {
        font-size: 0.9rem;
        opacity: 0.8;
    }

    .nav-menu {
        list-style: none;
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
    }

    .main-content {
        margin-left: calc(var(--sidebar-width) + 2rem);
        padding: 2rem 3rem;
        width: calc(100% - var(--sidebar-width) - 2rem);
        max-width: calc(100% - var(--sidebar-width) - 2rem);
        overflow-x: hidden;
        overflow-y: visible;
        box-sizing: border-box;
        position: relative;
        min-width: 0;
    }
    
    /* Garantir que o conteúdo não ultrapasse */
    .main-content > * {
        max-width: 100% !important;
        box-sizing: border-box !important;
    }
    
    .main-content .content-card,
    .main-content .page-header {
        width: 100% !important;
        max-width: 100% !important;
    }

    .page-header {
        margin-bottom: 2rem;
        background: white;
        padding: 1.5rem;
        border-radius: 15px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
    }

    .page-header h2 {
        color: var(--primary-color);
        font-size: 1.8rem;
        margin-bottom: 0.5rem;
    }

    .page-header p {
        color: #666;
    }

    .content-card {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 1.5rem;
        width: 100% !important;
        max-width: 100% !important;
        box-sizing: border-box !important;
        overflow-x: hidden !important;
        overflow-y: visible;
        min-width: 0;
        position: relative;
    }
    
    .content-card > * {
        max-width: 100% !important;
        box-sizing: border-box !important;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        color: var(--primary-color);
        font-weight: 500;
    }

    .form-control {
        width: 100%;
        padding: 0.8rem;
        border: 2px solid #e1e1e1;
        border-radius: 8px;
        font-size: 1rem;
        transition: border-color 0.3s ease;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--secondary-color);
    }

    .btn {
        padding: 0.8rem 1.5rem;
        border: none;
        border-radius: 8px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        text-decoration: none;
    }

    .btn-primary {
        background: var(--primary-color);
        color: white;
    }

    .btn-success {
        background: var(--success-color);
        color: white;
    }

    .btn-danger {
        background: var(--danger-color);
        color: white;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .table-responsive {
        overflow-x: auto;
        width: 100%;
        max-width: 100%;
    }

    .table {
        width: 100%;
        max-width: 100%;
        border-collapse: collapse;
        margin-bottom: 1rem;
        table-layout: auto;
    }

    .table th,
    .table td {
        padding: 1rem;
        text-align: left;
        border-bottom: 1px solid #e1e1e1;
    }

    .table th {
        background: #f8f9fa;
        color: var(--primary-color);
        font-weight: 600;
    }

    .table tr:hover {
        background: #f8f9fa;
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

    .alert {
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1rem;
    }

    .alert-success {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert-danger {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
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
        box-shadow: 0 2px 8px rgba(0,0,0,0.3);
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

        .main-content {
            margin-left: 0 !important;
            padding: 1rem 1.5rem;
            width: 100% !important;
            max-width: 100% !important;
            overflow-x: hidden;
        }
        
        html, body {
            overflow-x: hidden !important;
            width: 100%;
            max-width: 100%;
            position: relative;
        }
        
        .content-card {
            width: 100% !important;
            max-width: 100% !important;
            padding: 1rem !important;
        }

        .menu-toggle {
            display: block;
        }
        
        .content-card {
            margin-top: 0;
            width: 100% !important;
            max-width: 100% !important;
            padding: 1rem;
        }
        
        .page-header {
            margin-top: 0;
            padding: 1rem;
            width: 100% !important;
            max-width: 100% !important;
        }
        
        /* Garantir que modais fiquem acima do sidebar */
        .modal {
            z-index: 1055 !important;
        }
        
        .modal-backdrop {
            z-index: 1050 !important;
        }
        
        /* Overlay para fechar sidebar ao clicar fora */
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
    }
    
    @media (max-width: 576px) {
        .main-content {
            padding: 0.5rem;
        }
        
        .content-card {
            padding: 1rem;
            border-radius: 10px;
        }
        
        .page-header {
            padding: 0.8rem;
        }
        
        .page-header h2 {
            font-size: 1.5rem;
        }
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

    /* REMOVER COMPLETAMENTE AS SETAS DA PAGINAÇÃO */
    ul.pagination li.page-item:first-child,
    ul.pagination li.page-item:last-child,
    ul.pagination li.page-item a.page-link[aria-label*="previous"],
    ul.pagination li.page-item a.page-link[aria-label*="next"],
    ul.pagination li.page-item a.page-link[rel="prev"],
    ul.pagination li.page-item a.page-link[rel="next"],
    ul.pagination li.page-item.disabled span.page-link[aria-label*="previous"],
    ul.pagination li.page-item.disabled span.page-link[aria-label*="next"],
    ul.pagination li.page-item.disabled span.page-link[aria-hidden="true"] {
        display: none !important;
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
    <?php echo $__env->yieldContent('styles'); ?>
</head>

<body>
    <button class="menu-toggle" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>
    
    <div class="sidebar-overlay" onclick="toggleSidebar()"></div>
    
    <?php echo $__env->make('components.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <main class="main-content">
        <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
        <div class="alert alert-danger">
            <?php echo e(session('error')); ?>

        </div>
        <?php endif; ?>

        <?php echo $__env->make('components.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="page-header">
            <h2><?php echo $__env->yieldContent('page-title'); ?></h2>
            <p><?php echo $__env->yieldContent('page-description'); ?></p>
        </div>

        <div class="content-card">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.querySelector('.sidebar-overlay');
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
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

        });
    </script>
    <?php echo $__env->yieldContent('scripts'); ?>
</body>

</html><?php /**PATH C:\Users\User\Documents\GitHub\ProjetoBancoWeb\projetobanco\resources\views/layouts/app.blade.php ENDPATH**/ ?>