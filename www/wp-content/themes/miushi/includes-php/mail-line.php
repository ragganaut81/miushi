<?php

// Оформляем строчки в письмо
function mail_line($title, $data){
	if ( $data ):
	    if ($title):
	        return "{$title}: <strong>{$data}</strong><br>";
	    else:
	        return "{$data}<br>";
	    endif;
	endif;
}