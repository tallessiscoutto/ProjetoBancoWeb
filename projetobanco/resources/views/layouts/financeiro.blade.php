<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Sistema Bancário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/financeiro.css') }}">
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
        
        html, body {
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
        
        .container > * {
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

        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 10px 15px;
        }

        .form-control:focus, .form-select:focus {
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
    </style>
</head>
<body>
    <button class="menu-toggle" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>
    
    <div class="sidebar-overlay" onclick="toggleSidebar()"></div>
    
    @include('components.sidebar')
    
    <div class="container py-4">
        <div class="page-header">
            <h1 class="text-center">@yield('title')</h1>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
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
        });
    </script>
    
    @yield('scripts')
</body>
</html> 