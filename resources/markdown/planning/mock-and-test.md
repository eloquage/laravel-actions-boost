# Mock and test

## Mocking actions

Actions are resolved from the container. Replace them with mocks in tests:

```php
MyAction::mock()
    ->shouldReceive('handle')
    ->with($user, 'secret')
    ->andReturn($result);
```

Use **`shouldRun()`** / **`shouldNotRun()`** as shorthand for `handle` expectations. Use **`spy()`** and **`allowToRun()->andReturn(...)`** when you want to run first and assert later.

## Fake lifecycle

- **`isFake()`**: Whether the action is currently faked.
- **`clearFake()`**: Remove fake and use real implementation.

The same fake instance is reused; add expectations or call `clearFake` between tests as needed.

## Job assertions

Use **`Queue::fake()`**, then **`MyAction::assertPushed()`** / **`assertNotPushed()`** / **`assertPushedOn($queue)`**. Never use `Queue::assertPushed(MyAction::class)` or assert on `JobDecorator` — use the action’s static assertion methods.

## Feature tests

Hit routes that use actions as controllers. Assert redirects, validation errors, and authorization (e.g. 403). When using `ActionRequest`, validation and auth run automatically before `asController`.

## Pest

Use `mock()`, `spy()`, `Queue::fake()`, and action assertion methods as usual. Keep resolve-from-container so fakes are used when the code calls `MyAction::run()` or the controller invokes the action.

See [as-fake.md], [as-job.md].
