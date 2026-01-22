# Troubleshooting

## Action not resolved

- **Checks**: Constructor dependencies resolvable from container? `app(MyAction::class)` works?
- **Fix**: Ensure all constructor args are bound in the container; avoid passing unbound primitives.

## Validation / authorization not running

- **Checks**: Using **`ActionRequest`** in `asController`? If using **`WithAttributes`**, are you calling **`validateAttributes()`** or explicitly validating the request?
- **Fix**: Use `ActionRequest` when validation/authorization are on the action. With `WithAttributes`, either `validateAttributes()` or `$request->validate()` in `asController`.

## Job assertion failures

- **Checks**: Asserting on **`JobDecorator`** or **`MyAction::class`** with `Queue::assertPushed`?
- **Fix**: Use **`MyAction::assertPushed()`** / **`assertNotPushed()`** / **`assertPushedOn($queue)`** instead.

## Command not registered

- **Checks**: Action in Kernel **`$commands`** or **`Actions::registerCommands()`** called? **`$commandSignature`** defined?
- **Fix**: Register the action and set signature. If using `registerCommands`, ensure the action directory is scanned and `runningInConsole()` guard is correct if used.

## Listener not firing

- **Checks**: **EventServiceProvider** `$listen` or **`Event::listen`** correct? For **`ShouldQueue`**, queue worker running and driver configured?
- **Fix**: Verify event → action mapping and queue config.

## General

- Run **`php artisan optimize:clear`**.
- Check **`storage/logs/laravel.log`**.
- Use **`php artisan tinker`** to resolve actions and run `handle` manually.
