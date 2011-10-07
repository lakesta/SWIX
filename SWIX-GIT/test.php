<html>
<head>
<link href="Xtras/CSS/Xtras_Styles.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<?php
require_once('Work/Work_test.php');
$test = new Table($s["jake"], "SELECT * FROM movies", "jake");
$test->setPaging(True);
$test->setHiddenColumns(array("movieid"));
$test->draw()
?>
</body>
</html>