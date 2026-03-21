<?php
    // Mapear rotas para identificar a seção atual
    $currentRoute = Route::currentRouteName();
    $currentSection = null;
    
    // Identificar seção atual baseada na rota
    if (str_contains($currentRoute, 'Produtos')) {
        $currentSection = 'produtos';
    } elseif (str_contains($currentRoute, 'Clientes')) {
        $currentSection = 'clientes';
    } elseif (str_contains($currentRoute, 'Fornecedores')) {
        $currentSection = 'fornecedores';
    } elseif (str_contains($currentRoute, 'Funcionarios')) {
        $currentSection = 'funcionarios';
    } elseif (str_contains($currentRoute, 'Vendas')) {
        $currentSection = 'vendas';
    } elseif (str_contains($currentRoute, 'Compras')) {
        $currentSection = 'compras';
    } elseif (str_contains($currentRoute, 'Relatorios')) {
        $currentSection = 'relatorios';
    } elseif (str_contains($currentRoute, 'Reservas')) {
        $currentSection = 'reservas';
    } elseif (str_contains($currentRoute, 'Localizacao')) {
        $currentSection = 'localizacao';
    }
    
    // Definir todas as opções do menu
    $menuItems = [
        [
            'route' => 'home',
            'icon' => 'fa-home',
            'label' => 'Home',
            'section' => 'home'
        ],
        [
            'route' => 'Produtos.cadastro',
            'icon' => 'fa-box',
            'label' => 'Produtos',
            'section' => 'produtos'
        ],
        [
            'route' => 'Clientes.cadastro',
            'icon' => 'fa-users',
            'label' => 'Clientes',
            'section' => 'clientes'
        ],
        [
            'route' => 'Fornecedores.cadastro',
            'icon' => 'fa-truck',
            'label' => 'Fornecedores',
            'section' => 'fornecedores'
        ],
        [
            'route' => 'Funcionarios.cadastro',
            'icon' => 'fa-user-tie',
            'label' => 'Funcionários',
            'section' => 'funcionarios'
        ],
        [
            'route' => 'Vendas.cadastro',
            'icon' => 'fa-shopping-cart',
            'label' => 'Vendas',
            'section' => 'vendas'
        ],
        [
            'route' => 'Compras.cadastro',
            'icon' => 'fa-shopping-bag',
            'label' => 'Compras',
            'section' => 'compras'
        ],
        [
            'route' => 'Relatorios.vendas',
            'icon' => 'fa-chart-bar',
            'label' => 'Relatórios',
            'section' => 'relatorios'
        ],
        [
            'route' => 'Localizacao.index',
            'icon' => 'fa-map-marker-alt',
            'label' => 'Localização de Produtos',
            'section' => 'localizacao'
        ],
        [
            'route' => 'Reservas.cadastro',
            'icon' => 'fa-calendar-alt',
            'label' => 'Reservas',
            'section' => 'reservas'
        ]
    ];
    
    // Filtrar menu removendo a opção da seção atual
    $menuItems = array_filter($menuItems, function($item) use ($currentSection) {
        return $item['section'] !== $currentSection;
    });
?>

<nav class="sidebar">
    <div class="sidebar-header">
        <h1>Perfumes da Chiquinha</h1>
    </div>
    <ul class="nav-menu">
        <?php $__currentLoopData = $menuItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="nav-item">
            <a href="<?php echo e(route($item['route'])); ?>" class="nav-link">
                <i class="fas <?php echo e($item['icon']); ?>"></i>
                <?php echo e($item['label']); ?>

            </a>
        </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>

    <form method="POST" action="<?php echo e(route('logout')); ?>">
        <?php echo csrf_field(); ?>
        <button type="submit" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i>
            Sair
        </button>
    </form>
</nav>

<?php /**PATH C:\Users\User\Documents\GitHub\ProjetoBancoWeb\projetobanco\resources\views/components/sidebar.blade.php ENDPATH**/ ?>