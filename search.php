<?php

//workflow.phpの読み込み
require('workflows.php');
$w = new Workflows();

$q = "{query}";
$json = $w->request("http://webrandum.net/wp-json/wp/v2/posts/?search=" . urlencode( $q )."&_embed");

for($i=0; $i < 10; $i++){
  $array = json_decode( $json , true ) ;
  $title = $array[$i]["title"]["rendered"];
  $link = $array[$i]["link"];
  if($i == 9){
    $w->result(
      '10',
      'https://webrandum.net/?s='.$q,
      $q.'で検索',
      '',
      $icon
    );
  }else{
    $w->result(
      $i,
      $link,
      $title,
      '',
      $icon
    );
  }
}

echo $w->toxml();

?>