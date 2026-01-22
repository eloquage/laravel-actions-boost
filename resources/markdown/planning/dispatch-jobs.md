# Dispatch jobs

## When `handle` is enough

If job arguments match `handle`, you can dispatch without `asJob`:

```php
SendTeamReportEmail::dispatch($team);
```

Implement **`asJob`** when you need to transform arguments (e.g. pass different defaults) or add batch/job-specific logic.

## Dispatch methods

- **`dispatch(...)`**: Async.
- **`dispatchIf($condition, ...)`** / **`dispatchUnless($condition, ...)`**
- **`dispatchSync(...)`** / **`dispatchNow(...)`**: Sync.
- **`dispatchAfterResponse(...)`**: After response sent.

Use **`makeJob(...)`** when dispatching via `dispatch()` or building chains:

```php
dispatch(MyAction::makeJob($team));
MyAction::withChain([OtherAction::makeJob($x)])->dispatch($y);
```

## Configuring jobs

Use **`configureJob(JobDecorator $job)`** or properties (`$jobQueue`, `$jobTries`, etc.). Attach middleware via **`getJobMiddleware(array $parameters): array`**.

## Unique jobs

Implement **`ShouldBeUnique`** on the action. Use **`getJobUniqueId(...)`**, **`getJobUniqueFor(...)`**, **`getJobUniqueVia()`** to configure unicity.

## Batching

Use **`Bus::batch([MyAction::makeJob($a), ...])->...->dispatch()`**. In **`asJob`**, inject **`?Batch $batch`** as first parameter to react to batch cancellation.

## Testing

**`Queue::fake()`** then **`MyAction::assertPushed()`** / **`assertNotPushed()`** / **`assertPushedOn($queue)`**. Do not assert on `JobDecorator` or `MyAction::class` via `Queue::assertPushed`. See [as-job.md].
