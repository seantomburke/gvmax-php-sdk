<?php
require_once 'gvmax.class.php';

$gvmax = new GVMax('XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'); //get your API from www.gvmax.com

if($_GET)
{
	$output = $gvmax->sms($_GET['text'], $_GET['number']);
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<header>
<title>GVMax Send Example</title>
</header>
<h1>GVMax</h1>
<h2>Send a text with GVMax</h2>
<form name="input" action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
<input type="text" name="text" value="<?php echo $_GET['text']; ?>" placeholder="Text"/><br>
<input type="text" name="number" value="<?php echo $_GET['number']; ?>" placeholder="Number"/><br>
<input type="submit" value="Submit"/><br>
<?php echo $output ?>
</form>
</html>