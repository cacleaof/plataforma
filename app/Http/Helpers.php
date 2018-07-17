<?php 

function showstat($status)
{
	switch ($status) {
    case 'R' :
        return "Aguarda Regulação";
    case 'C' :
        return "Aguarda Consultor";
    case 'S' :
        return "Aguarda Solicitante";
    case 'F' :
        return "Finalizada";
    case 'D' :
        return "Devolvida e Finalizada";
    case 'A' :
        return "Aguarda Avaliação";
}
}
function tempo($created_at)
{
    $tempo = now()->diffInMinutes($created_at);

    $h = floor($tempo / 60);

        return $h.' hs';

}


?>