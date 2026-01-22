# As fake

Use `Lorisleiva\Actions\Concerns\AsFake` (included in `AsAction`) for mocking and spying in tests.

## `mock` / `partialMock` / `spy`

- **`mock()`**: Replace with a mock. Chain `shouldReceive('handle')->andReturn(...)`.
- **`partialMock()`**: Only mock specific methods.
- **`spy()`**: Run first, assert later with `shouldHaveReceived`.

## Helpers

- **`shouldRun()`**: Expect `handle` to be called (alias for `mock()->shouldReceive('handle')`).
- **`shouldNotRun()`**: Expect `handle` not to be called.
- **`allowToRun()`**: Used with spy; allow `handle` and optionally `andReturn(...)`.

## Fake lifecycle

- The same fake instance is reused across multiple `mock` / `spy` calls.
- **`isFake()`**: Returns whether the action is currently faked.
- **`clearFake()`**: Remove the fake and revert to the real implementation.

See [mock-and-test.md].
