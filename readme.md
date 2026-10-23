# Laravel Actions Boost

![Laravel Actions Boost](art/banner.png)

**A Laravel Boost extension that helps AI agents produce accurate, detailed
implementation plans for applications using Lorisleiva Laravel Actions (2.x).**

## Requirements

- PHP 8.2 or later
- Laravel Boost 1.8 or 2.x
- Filament 5

## Setup

Install Laravel Actions Boost using Composer:

```bash
composer require eloquage/laravel-actions-boost --dev
```

Then run the Boost installer and select **Laravel Actions Boost** when prompted:

```bash
php artisan boost:install
```

To verify installation, check your `AGENTS.md`, `CLAUDE.md`, or similar file for
a new **Laravel Actions Boost** section.

## Usage

1. Enable **planning mode** in your AI agent (Claude Code, Cursor, etc.)
2. Ask the agent to create a **Laravel Actions Boost plan** for your feature

Example prompt:

```
Create a Laravel Actions Boost plan for a user management feature.

Users can update their password via a web form (controller) and admins can
reset any user's password via an Artisan command. The same UpdateUserPassword
action should handle both. Use ActionRequest for validation (current password,
new password, confirmation). Add middleware auth for the route. Include tests
that mock the action and assert validation/authorization failures.
```

The guide helps the agent produce an implementation specification and asks for
clarification when requirements leave important choices open.

## What's Included

Laravel Actions Boost provides comprehensive planning guides covering:

- Action concept, handle, make/run, conventions, decorators
- Running as object, controller, command, job, listener
- Mocking and testing (mock, spy, assertPushed)
- Granular traits and WithAttributes / unified attributes
- Validation, authorization, ActionRequest
- Route registration, dispatch jobs, listen for events, execute as commands
- Checklist and troubleshooting

## License

MIT. Please see the [license file](license.md) for more information.
