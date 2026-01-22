# How does it work?

## Decorators

When an action is used as a controller, job, listener, or command, it is **never** used directly as that pattern. A **decorator** wraps the action and delegates to it.

- Controller → `ControllerDecorator`
- Job → `JobDecorator`
- Listener → `ListenerDecorator`
- Command → `CommandDecorator`

Benefits:

- No need to extend `Command`, implement `ShouldQueue`, or wrap logic in request/event APIs.
- No conflicts between patterns (e.g. controller vs job middleware).
- The action is always resolved and executed per request/job/listener/command; no shared state.

## Pattern detection

Laravel Actions does not override Laravel core. It uses **before-resolving callbacks** and **extenders** in the IoC container. The extender inspects `debug_backtrace` to detect how the action was dispatched and returns the appropriate decorator (or the raw action when used as an object).

Patterns are recognised only if the action uses the matching trait (e.g. `AsController`). If you use granular traits, only those patterns are considered.

## Mocking

The same extender detects when an action is mocked and returns the fake instance instead of the real one or a decorator.
