# One class, one task

Laravel Actions introduce a **unit of life**: an **action** — one class, one task.

## What is an action?

An action is a PHP class with a `handle` method. Add the `AsAction` trait and it becomes an action.

**Constraint**: The class must resolve from the container — `app(MyAction::class)` must not fail.

```php
use Lorisleiva\Actions\Concerns\AsAction;

class MyFirstAction
{
    use AsAction;

    public function __construct(protected MyInjectedService $service) {}

    public function handle(...$someArguments)
    {
        // Your action logic here...
    }
}
```

You can use constructor dependency injection. Prefer `AsAction`; alternatively use `extends \Lorisleiva\Actions\Action` or cherry-pick traits (see [granular-traits.md]).

## Running as an object

- **`make`**: Resolves the action from the container. Equivalent to `app(MyAction::class)`.
- **`run`**: Resolves and executes. Equivalent to `MyAction::make()->handle(...)`.

Always resolve from the container so you can inject dependencies and mock in tests.

## Conventions

### Verb-based names

Name actions as **short sentences that start with a verb**: e.g. `SendResetPasswordEmail`, `CreateNewLead`, `UpdateUserPassword`.

### `Actions` folder

Place actions under `app/Actions`, grouped by topic:

```
app/Actions/
├── Authentication/
│   ├── LoginUser.php
│   ├── RegisterUser.php
│   └── SendResetPasswordEmail.php
├── Leads/
│   ├── CreateNewLead.php
│   └── UpdateLeadDetails.php
└── Settings/
    └── UpdateUserPassword.php
```

Or `app/{Module}/Actions` if you use modules.

## How it works under the hood

When an action runs as a controller, job, listener, or command, Laravel Actions **wraps it in a decorator** (e.g. `ControllerDecorator`, `JobDecorator`). The action itself is never used directly as those patterns. See [how-does-it-work.md].
