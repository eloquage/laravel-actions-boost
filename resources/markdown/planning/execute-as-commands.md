# Execute as commands

## Registration

**Console Kernel**: Add the action to `$commands` in `app/Console/Kernel.php`:

```php
protected $commands = [
    UpdateUserRole::class,
];
```

**Auto-register**: Call **`Actions::registerCommands()`** (or `registerCommands('app/Actions')` / multiple paths) in a service provider. Optionally guard with **`$this->app->runningInConsole()`** so it only runs in CLI.

## Signature and metadata

Define **`$commandSignature`** (required when registered as command). Optionally **`$commandDescription`**, **`$commandHelp`**, **`$commandHidden`** or their getter equivalents.

## `asCommand`

Implement **`asCommand(Command $command)`** to read arguments/options, call `handle`, and output. You can use `$command->ask()`, `$command->choice()`, etc. for interactive input.

See [as-command.md].
