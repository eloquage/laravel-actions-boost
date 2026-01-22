# Plan Structure

> **For planning agents**: Your plan is the ONLY thing the implementing agent
> sees. Copy all relevant information from the guideline files into your plan.
> The implementing agent cannot access these files—if something isn't in your
> plan, they won't know it.

Your plan is a specification document for an implementing agent. It must be
complete enough that the implementing agent can write code without making
decisions.

## Before You Plan

Ask the user to clarify ambiguities before producing the plan. Don't guess.

| If the request mentions... | Ask about... |
| -------------------------- | ---------------------------------------------- |
| "Runs as job" | Queue name? Connection? Unique? Retries? |
| "Runs as controller" | Route? Middleware? JSON and/or HTML response? |
| "Runs as command" | Signature? Kernel vs registerCommands? |
| "Listens for events" | Which events? Queueable? |
| "Validation" | ActionRequest vs FormRequest? WithAttributes? |
| "Authorization" | Gate/policy? When (controller only vs always)? |

**When to ask vs proceed:**

- Ask when the answer affects routes, registration, or authorization
- Ask when there are multiple valid approaches with different tradeoffs
- Proceed when the choice is cosmetic or easily changed later

## Verifying Syntax

Before finalizing your plan, verify configuration methods using search-docs:

| Verify | How |
| ----------------------- | ----------------------------------------- |
| Action traits, methods | Check [as-object.md], [as-controller.md], [as-job.md], etc. |
| Validation/authorization | Check [validation-and-auth.md] |
| Route/command registration | Check [register-as-controller.md], [execute-as-commands.md] |

**Keep URLs in plans**: After verifying, include documentation URLs as backup
references. Don't replace URLs with "search for X" — implementing agents need
direct links.

## Planning Order

Build your plan in this order:

1. **Models first** — Define tables, attributes, relationships (if any)
2. **Actions second** — Class, traits, handle, asController/asCommand/asJob/asListener
3. **Routes / Events / Commands third** — Registration and wiring
4. **Authorization fourth** — Who can do what
5. **Tests last** — Mock, spy, assertPushed, feature tests

This order ensures you don't reference things that aren't yet defined.

## Required Formats

Every plan element MUST include these. Do not omit any.

**Action**: Full class name (e.g. `App\Actions\Authentication\UpdateUserPassword`), traits (`AsAction`, optionally `WithAttributes`), `handle` signature, `asController` / `asCommand` / `asJob` / `asListener` where used, `authorize` / `rules` / middleware.

**Route**: HTTP method, URI, action (invokable or explicit method), middleware.

**Event listener**: Event class, listener action class, queueable or not.

**Command**: Signature, description, action class, registration (Console Kernel vs `Actions::registerCommands`).

### Why Namespaces Matter

| Element | Namespace Pattern |
| -------------- | ----------------------------------------- |
| Actions | `App\Actions\{Topic}\{ActionName}` |
| Traits | `Lorisleiva\Actions\Concerns\AsAction`, `AsController`, etc. |
| Request | `Lorisleiva\Actions\ActionRequest` |
| Facade | `Lorisleiva\Actions\Facades\Actions` |

## New vs Update Plans

| Scenario | Commands | Specifications |
| --------------- | ------------------------ | -------------------------------- |
| New action | `php artisan make:action` (if available) or create class | Full specification |
| Update action | No scaffold | Only changes (Add/Modify/Remove) |
| New model | Create migration | Full attributes |
| Update model | Alter migration | Only changed attributes |

## Required Sections

Every plan needs these sections:

### 1. Commands

List every artisan command to run before writing code (e.g. `make:action`, migrations).

### 2. Actions

Specify every action: class, traits, handle, asX methods, authorize, rules, middleware. See [one-class-one-task.md], [as-controller.md], etc.

### 3. Routes (if controllers)

Define routes that use actions as controllers. See [register-as-controller.md].

### 4. Events (if listeners)

Define event → listener action registration. See [listen-for-events.md].

### 5. Commands (if Artisan)

Define command registration (Kernel or `Actions::registerCommands`). See [execute-as-commands.md].

### 6. Authorization

Describe who can do what. See [validation-and-auth.md].

### 7. Tests

List what to test. See [mock-and-test.md], [as-job.md] (assertPushed).

## File Directory

| File | Purpose |
| --------------------- | ---------------------------------------- |
| [overview.md] | Plan structure and required sections |
| [one-class-one-task.md] | Action concept, handle, make/run, conventions |
| [as-object.md] | make, run, runIf, runUnless |
| [as-controller.md] | asController, ActionRequest, routes, middleware |
| [as-command.md] | asCommand, signature, registration |
| [as-job.md] | asJob, dispatch, configureJob, assertPushed |
| [as-listener.md] | asListener, event registration |
| [as-fake.md] | mock, spy, shouldRun, clearFake |
| [granular-traits.md] | Cherry-picking traits |
| [with-attributes.md] | WithAttributes, fill, validateAttributes |
| [use-unified-attributes.md] | Optional attributes, validateAttributes |
| [validation-and-auth.md] | authorize, rules, ActionRequest |
| [register-as-controller.md] | Route registration, registerRoutes |
| [dispatch-jobs.md] | Dispatching, chaining, batching |
| [listen-for-events.md] | EventServiceProvider, Event::listen |
| [execute-as-commands.md] | Kernel, registerCommands |
| [mock-and-test.md] | Mocking, testing patterns |
| [how-does-it-work.md] | Decorators, container resolution |
| [checklist.md] | Common mistakes to avoid |
| [troubleshooting.md] | Diagnostic checks |

## When You're Stuck

| Situation | What to do |
| ---------------------------------- | -------------------------------------------- |
| Requirements contradict each other | Ask user which takes priority |
| Feature seems impossible | Ask user if you understood correctly |
| Multiple valid approaches | Explain tradeoffs, ask user to choose |
| Missing critical information | Ask user (see "Before You Plan" above) |
| Request is too large | Propose splitting into phases, confirm scope |

Don't guess on schema or authorization decisions.

## Before Finalizing

**You must review [checklist.md] before submitting your plan.**
