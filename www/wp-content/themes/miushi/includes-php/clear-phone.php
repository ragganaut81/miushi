<?php

// Очистить номер (Российский формат)
function phone_clear( $telephone ){
	$pc = preg_replace('~\D+~','',$telephone);

	if ( strlen( $pc ) > 7 ):
		switch (substr($pc, 0,1) ){
			case 7:
				$pc = '+'.$pc;
				break;
			case 8:
				$pc = '+7'.substr($pc, 1);
				break;
			case 9:
				$pc = '+7'.$pc;
				break;
		}
	endif;

	return $pc;
}