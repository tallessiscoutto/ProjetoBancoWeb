<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title'); ?> - Perfumes da Chiquinha</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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

    body {
        background-color: #f5f6fa;
        min-height: 100vh;
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
        margin-left: var(--sidebar-width);
        padding: 2rem;
    }

    .page-header {
        margin-bottom: 2rem;
        background: white;
        padding: 1.5rem;
        border-radius: 15px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 1rem;
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

    @media (max-width: 768px) {
        .sidebar {
            transform: translateX(-100%);
        }

        .main-content {
            margin-left: 0;
        }

        .menu-toggle {
            display: block;
        }
    }
    </style>
    <?php echo $__env->yieldContent('styles'); ?>
</head>

<body>
    <nav class="sidebar">
        <div class="sidebar-header">
            <h1>Perfumes da Chiquinha</h1>
        </div>

        <ul class="nav-menu">
            <li class="nav-item">
                <a href="<?php echo e(route('home')); ?>" class="nav-link">
                    <i class="fas fa-home"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo e(route('Produtos.cadastro')); ?>" class="nav-link">
                    <i class="fas fa-box"></i>
                    Produtos
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo e(route('Clientes.cadastro')); ?>" class="nav-link">
                    <i class="fas fa-users"></i>
                    Clientes
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo e(route('Fornecedores.cadastro')); ?>" class="nav-link">
                    <i class="fas fa-truck"></i>
                    Fornecedores
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo e(route('Funcionarios.cadastro')); ?>" class="nav-link">
                    <i class="fas fa-user-tie"></i>
                    Funcionários
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo e(route('Vendas.cadastro')); ?>" class="nav-link">
                    <i class="fas fa-shopping-cart"></i>
                    Vendas
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo e(route('Compras.cadastro')); ?>" class="nav-link">
                    <i class="fas fa-shopping-bag"></i>
                    Compras
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo e(route('Relatorios.vendas')); ?>" class="nav-link">
                    <i class="fas fa-chart-bar"></i>
                    Relatórios
                </a>
            </li>
        </ul>

        <form method="POST" action="<?php echo e(route('logout')); ?>">
            <?php echo csrf_field(); ?>
            <button type="submit" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                Sair
            </button>
        </form>
    </nav>

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

        <div class="page-header">
            <h2><?php echo $__env->yieldContent('page-title'); ?></h2>
            <p><?php echo $__env->yieldContent('page-description'); ?></p>
        </div>

        <div class="content-card">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </main>

    <?php echo $__env->yieldContent('scripts'); ?>
</body>

</html><?php /**PATH C:\Users\User\Documents\GitHub\ProjetoBancoWeb\projetobanco\resources\views/layouts/app.blade.php ENDPATH**/ ?>