<?php

define("BID", 0);
define("QTY", 1);
define("COMMISSION", .01);


/* 
 * IN: $book -> bitstamp book
 * IN: $qty -> quantity of bitcoin to buy/sell
 * IN: $action -> are we buying or selling?
 * OUT: price in (USD) for $qty Bitcoins including Commission
 */
function coin_to_usd($book, $qty, $action) 
{ 
  $cnt = 0; // current bid/ask we are looking at
  $total = 0; // total price
  $whats_left = $qty; // how many bitcoins are left to buy/sell 
  
  if($action == 'sell') {
    $book_data = $book->bids;    
  } else if($action == 'buy') {
    $book_data = $book->asks;
  }
  
  while($whats_left > 0) {
  
    if ($whats_left >= $book_data[$cnt][QTY]){ // need another bid
  
      $total += $book_data[$cnt][QTY] * $book_data[$cnt][BID];
      $whats_left = $whats_left - $book_data[$cnt][QTY];
  
    } else { // no more bids needed
    
      $total += $whats_left * $book_data[$cnt][BID];
      $whats_left = 0;
    }
  
    $cnt++;
  }
  
  return $total + $total * COMMISSION;
}


function total_ask_qty($book) 
{
  $asks = $book->asks;
  $ask_qty = 0;
  foreach($asks as $id => $ask) {
    $ask_qty += $ask[1];
  }
  return $ask_qty;
}


function total_bid_qty($book) 
{
  $bids = $book->bids;
  $bid_qty = 0;
  foreach ($bids as $id => $bid) {
    $bid_qty += $bid[QTY];
  }
  return $bid_qty;
}

?>