# As job

Actions can be dispatched as queued jobs. Use `Lorisleiva\Actions\Concerns\AsJob` (included in `AsAction`).

## `asJob`

Called when the action is dispatched as a job. Map job arguments to `handle`. If omitted, the decorator calls `handle` with the dispatch arguments.

```php
public function asJob(Team $team): void
{
    $this->handle($team, true); // fullReport
}
```

## Dispatching

- `MyAction::dispatch($arg1, $arg2)` — async
- `MyAction::dispatchIf($condition, ...)` / `dispatchUnless($condition, ...)`
- `MyAction::dispatchSync(...)` / `dispatchNow(...)` — sync
- `MyAction::dispatchAfterResponse(...)` — after response sent

**Do not** use `dispatch(MyAction::make())`. Use `MyAction::dispatch(...)` or `dispatch(MyAction::makeJob(...))` for custom dispatch.

## `makeJob` / `makeUniqueJob` / `withChain`

- `makeJob($...args)`: Build `JobDecorator` for use with `dispatch()` or chains.
- `makeUniqueJob($...args)`: Force unique job decorator.
- `withChain([...])`: Chain jobs. Use `makeJob` for chained actions.

## Configuration

Use `configureJob(JobDecorator $job)` or properties:

- `$jobConnection`, `$jobQueue`
- `$jobTries`, `$jobMaxExceptions`, `$jobBackoff`, `$jobTimeout`, `$jobRetryUntil`
- `getJobBackoff()`, `getJobRetryUntil()`, `getJobMiddleware()`
- `getJobDisplayName()`, `getJobTags()`
- `ShouldBeUnique`: `getJobUniqueId()`, `getJobUniqueFor()`, `getJobUniqueVia()`
- `jobFailed(?Throwable $e, ...$params)` for failure handling

## Batching

Inject `?Batch $batch` as first `asJob` parameter to detect batch cancellation.

## Testing

Use `Queue::fake()`, then **`MyAction::assertPushed()`** / `assertNotPushed()` / `assertPushedOn($queue)`. Do **not** assert on `JobDecorator` or `MyAction::class` with `Queue::assertPushed`.

See [dispatch-jobs.md].
