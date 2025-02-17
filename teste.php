<?php         

$pag_interval = 3;     

$pag_init = max($pag - $pag_interval, 1);         

$pag_final = min($total_pages, $pag + $pag_interval);    

$vetor["buttons"] = "";       

for($p = $pag_init; $p <= $pag_final; $p++){

$vetor["buttons"] .= "<div class='item2' data-id = '$p' id = 'btn'>$p</div>"; 

}     


?>     