<?php

require_once 'vendor/autoload.php';

$messages = [
  'Opening brace must be the last content of the line',
  'Closing brace must be on a line by itself',
  'Each PHP statement must be on a line by itself',
];

function build_comment($messages)
{
  $comment = '';

  foreach ($messages as $message) {
    $comment .= "- {$message}\n";
  }

  return $comment;
}

dd(build_comment($messages));
