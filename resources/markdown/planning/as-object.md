# As object

Methods provided by `Lorisleiva\Actions\Concerns\AsObject` (included in `AsAction`).

## `make`

Resolves the action from the container.

```php
MyAction::make();

// Equivalent to:
app(MyAction::class);
```

## `run`

Resolves and executes the action.

```php
MyAction::run($arg1, $arg2);

// Equivalent to:
MyAction::make()->handle($arg1, $arg2);
```

## `runIf`

Resolves and executes only if the condition is true.

```php
MyAction::runIf($condition, $arg1, $arg2);
```

## `runUnless`

Resolves and executes only if the condition is false.

```php
MyAction::runUnless($condition, $arg1, $arg2);
```

Use `make` when you need the instance (e.g. DI, testing). Use `run` / `runIf` / `runUnless` for one-off execution.
