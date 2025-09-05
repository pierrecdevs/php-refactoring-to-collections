<?php

use Illuminate\Support\Collection;

require_once 'vendor/autoload.php';

function load_json($path)
{
  return json_decode(file_get_contents(__DIR__ . '/' . $path), true);
}

function githubScore(Collection $events)
{
  return $events
    ->pluck('type')
    ->map(function ($eventType) {
      return collect([
        'PushEvent' => 5,
        'CreateEvent' => 4,
        'IssuesEvent' => 3,
        'CommitCommentEvent' => 2,
      ])->get($eventType, 1);
    })
    ->sum();
}

$events = load_json('data/events.json');
dd(githubScore(collect($events)));
