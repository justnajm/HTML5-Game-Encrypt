<?php
function matchCode($code,$pwd,$match=false)
{
	$result = false;
	$nextPos = $code[0];
	
	for($i=1;$i<=$code[0];$i++){
	
		$chr = substr($code,$nextPos+1,$code[$i]);
		
		$cd .= chr($chr);

		$nextPos += $code[$i];
		
	}

	$val = decrypt($cd	, $pwd);
	
	if($match)
	{
		$origVal = substr($code,$nextPos+1);
		
		if($origVal == "") return "You should pass the value at the end of the generated code";
		
		if($origVal == $val) $result = $val;
		else $result = false;
		
	} else {
		$result = $val;
	}
	
	return $result;
}


function decrypt($val,$pwd){ 

	 $key = array(256);
	 $sind = array(256);

	 $enc = "";
	 $j = 0;
	 $a = 0;
	 $k = 0;
	 $tmp = 0;
	 
	 for($i = 0; $i < 256; $i++){
		$key[$i] = ord(substr($pwd,($i % strlen($pwd)),1));
		$ind[$i] = $i;
	 }

	 $j = 0;
	 for($i = 0; $i < 256; $i++) {
		$j = ($j + $ind[$i] + $key[$i]) % 256;
		$tmp = $ind[$i];
		$ind[$i] = $ind[$j];
		$ind[$j] = $tmp;
	 }
	 
	 $j = 0;
	 $a = 0;
	 $hint = "";
    for($i = 0; $i < strlen($val); $i++) {
       $a = ($a + 1) % 256;
       $j = ($j + $ind[$a]) % 256;
       $tmp = $ind[$a];
       $ind[$a] = $ind[$j];
       $ind[$j] = $tmp;
       $k = $ind[($ind[$a] + $ind[$j]) % 256];
       $ord = ord(substr($val,$i,1));
       $enc .= "" . chr($ord ^ $k);
    }
	
	return $enc;//strlen($hint) . "" . $hint . "" . $enc . "" . $val;
}
echo "<h4>Recieved: " . $_GET['code'] . "</h4>";
echo "<h4>Decrypted: " . matchCode($_GET['code'],$_GET['pwd']) . "</h4>";
?>