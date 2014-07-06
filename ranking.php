<?php
debug_backtrace();
    mysql_connect($dbhost, $dbuser, $dbpassword);
    mysql_select_db($db);

    $result = mysql_query("SELECT name, bankacc FROM players ORDER BY bankacc DESC LIMIT 10;");

    if(mysql_num_rows($result) > 0){
        echo("<html>");
        echo("<body>");
        echo("<ol style='text-decoration: none;'>");


    while($row = mysql_fetch_array($result)){
        $name = $row["name"];
        $money = $row['bankacc'];

        echo("<li>$name '$'$money</li>");
    }
        echo("</ol>");
        echo("</body");
        echo("</html");

    } else {
        echo ("Error collecting results!");
    }
    debug_print_backtrace();
?>
