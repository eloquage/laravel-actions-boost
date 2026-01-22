# Checklist

Review before finalizing a Laravel Actions plan.

## Vague specs

| Bad | Good |
| ----- | ----- |
| "Add an action" | Full spec: class, traits, `handle`, `asController`/`asJob`/etc., `authorize`, `rules`, middleware |
| "Validate input" | `rules()` plus `ActionRequest` or `WithAttributes` + `validateAttributes` |
| "Dispatch as job" | `asJob` vs `handle`, queue, `configureJob`, unique? |

## Namespaces

Use full namespaces: `Lorisleiva\Actions\Concerns\AsAction`, `App\Actions\...`, `Lorisleiva\Actions\ActionRequest`.

## Dispatch and job assertions

| Wrong | Right |
| ----- | ----- |
| `dispatch(MyAction::make())` | `MyAction::dispatch(...)` or `dispatch(MyAction::makeJob(...))` |
| `Queue::assertPushed(MyAction::class)` | `MyAction::assertPushed()` |
| Assert on `JobDecorator` | Use action’s `assertPushed` / `assertNotPushed` / `assertPushedOn` |

## Auth and validation

- Auth/validation apply when running as **controller** (or when using **`WithAttributes`** + **`validateAttributes`**).
- Use **`ActionRequest`** (not `Request`) when validation/authorization live on the action.
- Specify **`authorize`** and **`rules`** (or equivalent) in the plan.

## Registration

- **Routes**: Explicit routes or `routes()` + `Actions::registerRoutes()`.
- **Events**: `EventServiceProvider` or `Event::listen`.
- **Commands**: Kernel `$commands` or `Actions::registerCommands()`.

## Tests

- Happy path, validation failures, authorization failures.
- Job/listener: `Queue::fake` + `MyAction::assertPushed` (or similar).
- Mock/spy when asserting action behaviour in isolation.
