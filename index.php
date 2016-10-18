<?php
/*
* Setup Autoloader
*/

require('load.php');
require_once('templates/Page.php');

$page = new Page();
$page->set_title('Welcome!');
$page->start_body();
?>
<h1>Welcome to Murmur</h1>
<p>
  stuff here
</p>
<?php
$page->end_body();
echo $page->render('templates/template.php');
