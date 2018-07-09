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
?>