# As command

Actions can run as Artisan commands. Use `Lorisleiva\Actions\Concerns\AsCommand` (included in `AsAction`).

## `asCommand`

Called when the action runs as a command. Receives `Illuminate\Console\Command`. Parse arguments/options and call `handle`.

```php
use Illuminate\Console\Command;

public function asCommand(Command $command): void
{
    $user = User::findOrFail($command->argument('user_id'));
    $this->handle($user, $command->argument('password'));
    $command->info('Done.');
}
```

## Signature and description

Use properties or getters:

| Property | Getter | Purpose |
| -------- | ------ | ------- |
| `$commandSignature` | `getCommandSignature()` | e.g. `'users:update-password {user_id} {password}'` |
| `$commandDescription` | `getCommandDescription()` | Shown in `php artisan list` |
| `$commandHelp` | `getCommandHelp()` | Shown with `--help` |
| `$commandHidden` | `isCommandHidden()` | Hide from `php artisan list` |

```php
public string $commandSignature = 'users:update-password {user_id} {password}';
public string $commandDescription = 'Updates the password of a user.';
public bool $commandHidden = false;
```

## Registration

- **Console Kernel**: Add the action class to `$commands` in `app/Console/Kernel.php`.
- **Auto-register**: Call `Actions::registerCommands()` (or `registerCommands('app/Actions')`) in a service provider. Optionally guard with `$this->app->runningInConsole()`.

See [execute-as-commands.md].
