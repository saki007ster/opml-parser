#!/usr/bin/php
<?php

if ( count($argv) > 1 ) {

 $str = $argv[1];
  $doc = new DOMDocument();
  $doc->load($str);

  $str = $doc->saveXML() . "\n";
  
  $xml = new SimpleXMLElement($str);
  foreach ($xml->children() as $second_gen) 
  {
    	foreach ($second_gen->children() as $third_gen) 
	{
      $op.=  ' <h1> ' . $third_gen['text'] .'</h1>';
        	foreach ($third_gen->children() as $fourth_gen)
	 	{
			$op.=  ' <h2>' . $fourth_gen['text'].'</h2>' ;
			foreach ($fourth_gen->children() as $fifth_gen) 
			{
        		$op.=  ' <p>' . $fifth_gen['text'].'</p>' ;
				foreach ($fifth_gen->children() as $sixth_gen) 
				{
					$op.=  '<ul>';
        				$op.=  ' <li><strong>'. $sixth_gen['text'].'</strong></li>';					

          nest($sixth_gen,$op);
        $op.=  '</ul>';
     		}
      }
	}
  }
}
$handle=fopen('output.html','w');
fwrite($handle,$op);
}

else
{
  echo "run with file name";
}

function countChild($node) {
  return count($node->children());
}

function nest($node,&$op) {
while(countChild($node))
{
  foreach($node->children() as $i)
  {
    $op.= '<ul>';
    $op.= '<li>'.$i['text'].'</li>' ;
    nest($i,$op);
    $op.= '</ul>';
  }  
  break;
}
}

?>

