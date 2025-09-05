<?php

require_once 'vendor/autoload.php';

$messages = [
  'Opening brace must be the last content of the line',
  'Closing brace must be on a line by itself',
  'Each PHP statement must be on a line by itself',
];

function build_comment($messages)
{
  return collect($messages)->map(function ($message) {
    return "- {$message}";
  })->implode("\n");
}

dd(build_comment($messages));
