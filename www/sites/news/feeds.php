<?php
    include("../../settings/config.php");
    include("../../settings/databaseinfo.php");
    include("../../settings/json.php");
    include("../../settings/mysql.php");
    include("../../check.php");

    header("Content-Type: application/rss+xml; charset=UTF-8");

    echo '<?xml version="1.0" encoding="UTF-8"?>';
    echo '<rss version="2.0">';
    echo '<channel>';
    echo '<title>'.SYSNAME.' WebUI RSS News Feed Reader</title>';
    echo '<link>'.SYSURL.'</link>';
    echo '<description>This is '.SYSNAME.' WebUI RSS News Feed Reader</description>';
    echo '<language>en-us</language>';
    echo '<copyright>Copyright (C) 2013 '.SYSURL.'</copyright>';

    $DbLink = new DB;
    $query = "";
    $querypage = $querypage * 5;
    $result = $DbLink->query("SELECT id, title, message, time, user FROM " .C_NEWS_TBL .$query. " ORDER BY time DESC LIMIT $querypage," .($querypage + 5));
    $count = 0;

	if (!$result) {die('Requête invalide : ' . mysql_error());}

	else
	{
        while (list($id, $title, $message, $time, $user) = $DbLink->next_record())
        {
            echo '<item>';
			echo '<title>' .htmlspecialchars($title). '</title>';
			echo '<description>' .htmlspecialchars($message). '</description>';		
            echo '<link>' .$link. '</link>';
            echo '<author>' .$user. '</author>';
            echo '<pubDate>' .date("l M d Y", $time). '</pubDate>';
            echo '</item>';
            $count++;
        }
    }
    echo '</channel>';
    echo '</rss>';
?>