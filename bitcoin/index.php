<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'include.inc';

$json = file_get_contents('https://www.bitstamp.net/api/order_book/');
$book = json_decode($json);

if(isset($_POST['action'])) {
  $action = $_POST['action'];
} else {
  $action = NULL;
}
if(isset($_POST['qty'])) {
  $qty = $_POST['qty']; 
} else {
  $qty = NULL;
}

$results = coin_to_usd($book, $qty, $action);  

?>

<html>

<head>
  <title>Bitcoin</title>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="styles.css">  
  
  <script type="text/javascript">  
    var bid_limit = <?php print total_bid_qty($book); ?>;
    var ask_limit = <?php print total_ask_qty($book); ?>;    
  </script>
  <script type="text/javascript" src="script.js"></script>
  <meta name="viewport" content="width=device-width, user-scalable=no">
  
</head>

<body>

  <h1>Hello <span>Bitcoin</span> World</h1>
  <p id="hero">Currently, you could buy <em><?php print number_format(total_ask_qty($book), 6, '.', ','); ?></em> Bitcoins.</p>

  <form id="main-form" method="post" class="cf">
    <p>I would like to</p>  
    <select name="action" id="action">
      <option value="buy" <?php if($action=='buy') print "selected"; ?>>Buy</option>
      <option value="sell" <?php if($action=='sell') print "selected"; ?>>Sell</option>
    </select>  
    <input type="text" id="qty" name="qty" value="<?php print $qty; ?>">  
    <p>Bitcoins.</p>
    <input type="submit" value="GO" />
  
  </form>
  
  <?php if($action) { ?>
  <div id="results">
  
    <p>You can <?php print $action; ?> 
    <strong><?php print number_format($qty, 2, '.', ','); ?></strong> 
    Bitcoins for <strong>$
    <?php print number_format($results, 2, '.', ','); ?>
    <strong></p>
  
  </div>
  <?php } ?>
  
  <pre><code><?php //print_r($book); ?></code></pre>

</body>
</html>