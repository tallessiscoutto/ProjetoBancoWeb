<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Perfumes da Chiquinha</title>
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

    .dashboard-header {
        margin-bottom: 2rem;
    }

    .dashboard-header h2 {
        color: var(--primary-color);
        font-size: 1.8rem;
        margin-bottom: 0.5rem;
    }

    .dashboard-header p {
        color: #666;
    }

    .cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .card {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .card-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
        font-size: 1.5rem;
        color: white;
    }

    .card-title {
        font-size: 1.1rem;
        color: var(--primary-color);
        margin-bottom: 0.5rem;
        font-weight: 600;
    }

    .card-description {
        font-size: 0.9rem;
        color: #666;
        margin-bottom: 1rem;
    }

    .card-link {
        display: inline-flex;
        align-items: center;
        color: var(--secondary-color);
        text-decoration: none;
        font-weight: 500;
        font-size: 0.9rem;
        margin-top: auto;
    }

    .card-link i {
        margin-left: 5px;
        transition: transform 0.3s ease;
    }

    .card-link:hover i {
        transform: translateX(5px);
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
            z-index: 1000;
        }

        .main-content {
            margin-left: 0;
        }

        .menu-toggle {
            display: block;
        }
    }
    </style>
</head>

<body>
    <nav class="sidebar">
        <div class="sidebar-header">
            <h1>Perfumes da Chiquinha</h1>
        </div>
        <ul class="nav-menu">
            <li class="nav-item">
                <a href="{{ route('Produtos.cadastro') }}" class="nav-link">
                    <i class="fas fa-box"></i>
                    Produtos
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('Clientes.cadastro') }}" class="nav-link">
                    <i class="fas fa-users"></i>
                    Clientes
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('Fornecedores.cadastro') }}" class="nav-link">
                    <i class="fas fa-truck"></i>
                    Fornecedores
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('Funcionarios.cadastro') }}" class="nav-link">
                    <i class="fas fa-user-tie"></i>
                    Funcionários
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('Vendas.cadastro') }}" class="nav-link">
                    <i class="fas fa-shopping-cart"></i>
                    Vendas
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('Compras.cadastro') }}" class="nav-link">
                    <i class="fas fa-shopping-bag"></i>
                    Compras
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('Relatorios.vendas') }}" class="nav-link">
                    <i class="fas fa-chart-bar"></i>
                    Relatórios
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('Localizacao.index') }}" class="nav-link">
                    <i class="fas fa-map-marker-alt"></i>
                    Localização de Produtos
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('Reservas.cadastro') }}" class="nav-link">
                    <i class="fas fa-calendar-alt"></i>
                    Reservas
                </a>
            </li>
        </ul>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                Sair
            </button>
        </form>
    </nav>

    <main class="main-content">
        <div class="dashboard-header">
            <h2>Dashboard</h2>
            <p>Gerencie seu negócio de forma eficiente</p>
        </div>

        <div class="cards-grid">
            <div class="card">
                <div class="card-icon" style="background: var(--info-color)">
                    <i class="fas fa-box"></i>
                </div>
                <h3 class="card-title">Produtos</h3>
                <p class="card-description">Gerencie seu catálogo de produtos</p>
                <a href="{{ route('Produtos.cadastro') }}" class="card-link">
                    Acessar <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="card">
                <div class="card-icon" style="background: var(--success-color)">
                    <i class="fas fa-users"></i>
                </div>
                <h3 class="card-title">Clientes</h3>
                <p class="card-description">Cadastre e gerencie seus clientes</p>
                <a href="{{ route('Clientes.cadastro') }}" class="card-link">
                    Acessar <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="card">
                <div class="card-icon" style="background: var(--warning-color)">
                    <i class="fas fa-truck"></i>
                </div>
                <h3 class="card-title">Fornecedores</h3>
                <p class="card-description">Gerencie seus fornecedores</p>
                <a href="{{ route('Fornecedores.cadastro') }}" class="card-link">
                    Acessar <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="card">
                <div class="card-icon" style="background: var(--danger-color)">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <h3 class="card-title">Vendas</h3>
                <p class="card-description">Registre e gerencie vendas</p>
                <a href="{{ route('Vendas.cadastro') }}" class="card-link">
                    Acessar <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="card">
                <div class="card-icon" style="background: var(--primary-color)">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <h3 class="card-title">Compras</h3>
                <p class="card-description">Registre compras de produtos</p>
                <a href="{{ route('Compras.cadastro') }}" class="card-link">
                    Acessar <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="card">
                <div class="card-icon" style="background: #16a085">
                    <i class="fas fa-user-tie"></i>
                </div>
                <h3 class="card-title">Funcionários</h3>
                <p class="card-description">Cadastre e gerencie funcionários</p>
                <a href="{{ route('Funcionarios.cadastro') }}" class="card-link">
                    Acessar <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="card">
                <div class="card-icon" style="background: #8e44ad">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <h3 class="card-title">Relatórios</h3>
                <p class="card-description">Visualize relatórios e estatísticas</p>
                <a href="{{ route('Relatorios.vendas') }}" class="card-link">
                    Acessar <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="card">
                <div class="card-icon" style="background: #2ecc71">
                    <i class="fas fa-bookmark"></i>
                </div>
                <h3 class="card-title">Reservas</h3>
                <p class="card-description">Gerencie reservas de produtos</p>
                <a href="{{ route('Reservas.cadastro') }}" class="card-link">
                    Acessar <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="card">
                <div class="card-icon" style="background: #d35400">
                    <i class="fas fa-handshake"></i>
                </div>
                <h3 class="card-title">Localização de Produtos</h3>
                <p class="card-description">localização de produtos no estoque</p>
                <a href="{{ route('Localizacao.index') }}" class="card-link">
                    Acessar <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </main>
</body>

</html>