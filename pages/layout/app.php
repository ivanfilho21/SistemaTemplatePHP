<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OO Test | <?= $title ?></title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="pages/layout/app.css">
</head>
<body class="d-flex flex-column">
    <header class="header">
        <nav class="navbar navbar-expand navbar-light bg-light">
            <a class="navbar-brand" href="./home">
                <span style="color: dodgerblue;">OO</span>
                <span style="font-weight: bold; color: firebrick;">Test</span>
            </a>

            <ul class="navbar-nav">
                <?php foreach ($pages as $key => $pg): ?>
                <li class="nav-item<?= ($page === $key) ? " active" : "" ?>"><a class="nav-link" href="./<?= $key ?>"><?= $pg["title"] ?></a></li>
                <?php endforeach ?>
            </ul>
        </nav>
    </header>

    <main class="main py-3">
        <!-- col-12 col-md-9 col-xl-8 py-3 pl-md-5 -->
        <?php
        
        $view = $page;
        $view .= (strpos(".php", $view) !== false) ? ".php" : "";
        // echo $view;
        require "pages/$page.php";
        ?>

    </main>

    <footer class="footer py-4 bg-dark text-white-50">
        <div class="container text-center">
            <small>Copyright &copy; 2019 - OO Test</small>
        </div>
    </footer>
</body>
</html>