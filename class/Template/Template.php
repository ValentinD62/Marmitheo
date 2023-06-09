<?php

namespace Template;

class Template {

    public static function render(string $content): void
    {
        ?>

        <!doctype html>
        <html lang="en">
        <head>
            <link rel="stylesheet" href="../css/style.css">

            <?php include "..\javascript\creation.php";?>

            <meta charset="UTF-8">
            <title>PROJET TROP BIEN</title>

        </head>
        <body>
            <?php include "header.php";
            ?>
            <div id="main-content">

                <?php echo $content ?> <!-- INJECTION DU CONTENU -->

            </div>
            <?php include "..\javascript\adetail.php";?>
            <?php include "..\javascript\aedit.php";?>
            <?php include "..\javascript\script.php";?>
        </body>
        <?php include "footer.php" ?>
        </html>

        <?php
    }

}
