<?php
                            include("pages/meeting-description-add/meeting-date.php");
                            spl_autoload_extensions('.php');
                            spl_autoload_register();

                            use classes\thai as thai;
                        ?>
                        <!DOCTYPE html>
                        <html>
                        <head>
                            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                            <title>Test PHP</title>
                        </head>
                        <body>
                            <?php
                            $mydate = new DateTime();
                            echo thai::date_format($mydate, 'r');
                            echo '<br />';
                            echo thai::date_format($mydate, 'วันlที่ d F พ.ศ. Y H:i:s');
                            echo '<br />';
                            echo thai::date_format($mydate, 'l j M Y');
                            echo '<br />';
                            echo thai::date_format($mydate, 'd/m/y');
                            echo '<br />';
                            echo thai::date_format($mydate, 'D Y-n-j');
                            echo '<br />';
                            echo thai::date_format($mydate, '\D Y-n-j'); // ใช้งาน escape character
                            echo '<br /><br />';

                            $number = 909876543121.25;
                            echo thai::number($number);
                            echo '<br />';
                            echo thai::number_format($number, 2);
                            echo '<br />';
                            echo thai::number_format($number, 4, ',', '.');
                            echo '<br />';
                            echo thai::number_totext($number);
                            echo '<br />';
                            echo thai::number_tobaht($number);
                            echo '<br />';
                            echo thai::number_tobaht('12345678909876543121.3456'); // เกิน float max value ให้ใช้ string
                            echo '<br />';
                            ?>
                        </body>
                        </html>