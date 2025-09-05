<?php

use Illuminate\Support\Collection;

require_once 'vendor/autoload.php';

class GitHubScore
{
  private Collection $events;

  private function __construct(Collection | array $events)
  {
    $this->events = collect($events);
  }

  public static function score(Collection $events)
  {
    return (new static($events))->scoreEvents();
  }

  private function scoreEvents()
  {
    return $this->events
      ->pluck('type')
      ->map(function ($eventType) {
        return $this->lookupEventScore($eventType);
      })
      ->sum();
  }

  private function lookupEventScore($eventType)
  {
    return collect([
      'PushEvent' => 5,
      'CreateEvent' => 4,
      'IssuesEvent' => 3,
      'CommitCommentEvent' => 2,
    ])->get($eventType, 1);
  }
}

function load_json($path)
{
  return json_decode(file_get_contents(__DIR__ . '/' . $path), true);
}

$events = collect(load_json('data/events.json'));
dd(GitHubScore::score($events));
