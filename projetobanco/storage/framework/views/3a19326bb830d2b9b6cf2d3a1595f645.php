<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Painel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    @media (min-width: 1000px) {

        html,
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: rgb(2, 117, 88);
            height: 100%;
            width: 100%;
            box-sizing: border-box;
        }

        .content {
            display: flex;
            flex-direction: column;
            min-height: 99%;
            width: 99%;
        }

        .logo {
            margin-top: 50px;
            text-align: center;
        }

        .logotipo {
            width: 300px;
            height: 300px;
            border-radius: 50%;
            box-shadow: 0 2px 8px rgba(255, 255, 255, 0.1);
        }

        .card {
            margin-top: 60px;
            display: flex;
            flex-direction: column;
            flex: 1;
            background-color: #fff;
            border-radius: 50px 50px 0 0;
            box-shadow: 0 2px 8px rgba(255, 255, 255, 0.1);
            padding: 20px;
            width: 99%;
            margin-left: auto;
            margin-right: auto;
        }

        .card h3 {
            font-size: 60px;
            text-align: center;
            color: rgb(2, 117, 88);
        }

        .card p {
            display: flex;
            justify-self: center;
            justify-content: center;
            font-size: 40px;
            text-align: center;
            color: rgb(2, 117, 88);
        }

        .button {
            margin-top: 80px;
            width: 400px;
            position: relative;
            left: 38%;
            height: 80px;
            font-size: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgb(2, 117, 88);
            color: #fff;
            text-decoration: none;
            border-radius: 25px;
        }

        .button:hover {
            background-color: rgb(2, 167, 250);
        }
    }

    @media (max-width: 768px) {

        html,
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: rgb(6, 82, 63);
            height: 100%;
            width: 100%;
            box-sizing: border-box;
        }

        .content {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            min-height: 90vw;
            width: 90vw;
        }

        .logo {
            margin-top: 20px;
            margin-left: 13%;
            display: flex;
            justify-content: center;
            text-align: center;
        }

        .logotipo {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            box-shadow: 0 2px 8px rgba(255, 255, 255, 0.1);
        }

        .card {
            margin-top: 15px;
            flex: 1;
            background-color: #fff;
            border-radius: 50px 50px 0 0;
            box-shadow: 0 2px 8px rgba(255, 255, 255, 0.1);
            padding: 5vw;
            width: 100%;
        }

        .card h3 {
            font-size: 60px;
            text-align: center;
            color: rgb(2, 117, 88);
            margin-bottom: 2vw;
        }

        .card p {
            font-size: 30px;
            text-align: center;
            color: rgb(2, 117, 88);
            margin-bottom: 5vw;
        }

        .button {
            margin-top: 80px;
            width: 350px;
            height: 80px;
            font-size: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgb(2, 117, 88);
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 25px;
            cursor: pointer;
        }

        .button:hover {
            background-color: rgb(2, 167, 250);
        }
    }
    </style>
</head>

<body>
    <div class="content">
        <div class="logo">
            <img class="logotipo" src="<?php echo e(asset('logo.jpeg')); ?>" alt=>
        </div>
        <div class="card">
            <h3>Bem vindo ao SaluzWay</h3>
            <p>Administre sua dieta, planos de treino e conquiste sua saúde ideal</p>
            <a href="#" class="button">Começar</a>
        </div>
    </div>
</body>

</html><?php /**PATH C:\Users\User\Documents\GitHub\projetoSaluz\resources\views/home.blade.php ENDPATH**/ ?>