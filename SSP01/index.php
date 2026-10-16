<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="author" content="Weston Matula">
    <meta name ="description" content="CS2623 - Server Side Programming">
    <meta name ="keywords" content="CS2623, Server Side Programming, PHP, HTML, CSS, OCCC">

    <title>CS2623 - Server Side Programming</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <header>
        <h1>CS2623 - Server Side Programming</h1>
        <p> SSP01 - PHP Basics</p>
    </header>

    <nav>
        <a href="index.php">SSP01</a>
        <a href="../SSP02/SSP02.php">SSP02</a>
        <a href="#">SSP03</a>
        <a href="#">SSP04</a>
        <a href="#">SSP05</a>
        <a href="#">SSP06</a>
        <a href="#">SSP07</a>
        <a href="#">SSP08</a>
        <a href="#">SSP09</a>
        <a href="#">SSP10</a>
        <a href="#">SSP11</a> 
        <a href="#">SSP12</a>
    </nav>

    <main>
        <h2>PHP Basics</h2>
        <p>This is my first webpage for Server Side Programming.</p>

        <h2>PHP Hello World Test Example</h2>
        <p>
            <?php
                $message = "Hello, World!";
                echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
            ?>
        </p>
    </main>

    <footer>
        <p>&copy; Weston Matula. For educational purposes only.</p>
    </footer>
</body>
</html>