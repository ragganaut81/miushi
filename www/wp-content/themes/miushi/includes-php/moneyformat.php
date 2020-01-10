<?php

// Отбиваем разрядность в числах

function moneyformat( $num ){
    $num = $num * 1;
    if ( is_integer($num) ):
        return number_format($num, 0, ',', '&thinsp;');
    endif;
}