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
            <script defer src="../javascript/script.js"></script>
            <script defer src="../javascript/creation.js"></script>
            <script defer src="../javascript/rechercheadetail.js"></script>
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


        </body>
        <?php include "footer.php" ?>
        </html>

        <?php
    }

}
