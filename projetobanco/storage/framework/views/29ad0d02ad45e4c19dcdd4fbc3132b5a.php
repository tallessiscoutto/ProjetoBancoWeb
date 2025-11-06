<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title><?php echo $__env->yieldContent('title', 'Painel Administrativo'); ?></title>
    <style>
    /* Reset básico */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f8f9fa;
    }

    .container {
        display: flex;
        min-height: 100vh;
    }

    /* Sidebar */
    .sidebar {
        width: 220px;
        background-color: #343a40;
        color: #fff;
        padding: 20px;
    }

    .sidebar h2 {
        text-align: center;
        margin-bottom: 30px;
    }

    .sidebar a {
        display: block;
        color: #adb5bd;
        padding: 10px;
        text-decoration: none;
        border-radius: 4px;
        margin-bottom: 10px;
    }

    .sidebar a:hover {
        background-color: #495057;
        color: #fff;
    }

    /* Main content */
    .main {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    /* Header */
    .header {
        background-color: #fff;
        padding: 15px 20px;
        border-bottom: 1px solid #dee2e6;
    }

    .header h1 {
        font-size: 24px;
        color: #343a40;
    }

    /* Content */
    .content {
        padding: 20px;
        flex: 1;
    }

    /* Cards */
    .card {
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: 4px;
        padding: 20px;
        margin-bottom: 20px;
    }

    .card h3 {
        margin-bottom: 15px;
        color: #343a40;
    }

    .button {
        display: inline-block;
        background-color: #007bff;
        color: #fff;
        padding: 10px 15px;
        border-radius: 4px;
        text-decoration: none;
    }

    .button:hover {
        background-color: #0069d9;
    }
    </style>
</head>

<body>
    <div class="container">
        <?php echo $__env->make('partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="main">
            <?php echo $__env->make('partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <div class="content">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>
    </div>
</body>

</html><?php /**PATH C:\Users\User\projetofit2\resources\views/layouts/app.blade.php ENDPATH**/ ?>