<?php

function addBasicClass( $text, $someclass='' ){
    $text = str_replace("<p>", "<p class='p {$someclass}'>", $text);
    $text = str_replace("<ul>", "<ul class='ul {$someclass}'>", $text);
    $text = str_replace("<strong>", "<strong class='strong {$someclass}'>", $text);
    return $text;
}