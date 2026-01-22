## Laravel Actions Boost

You are writing Laravel Actions (2.x) implementation plans. Plans must be specific enough
that an implementing agent can write code without making decisions.

**Start here**: Read
`/vendor/eloquage/laravel-actions-boost/resources/markdown/planning/overview.md` for plan format,
required sections, and what to clarify with the user before planning.

### Planning Guides

| Guide | Purpose |
|-------|---------|
| `overview.md` | Plan structure, required sections, file index |
| `one-class-one-task.md` | Action concept, handle, make/run, conventions, decorators |
| `as-object.md` | make, run, runIf, runUnless |
| `as-controller.md` | asController, ActionRequest, routes, middleware, json/html response |
| `as-command.md` | asCommand, signature, description, registration |
| `as-job.md` | asJob, dispatch, configureJob, chains, unique jobs, assertPushed |
| `as-listener.md` | asListener, event registration, queueable |
| `as-fake.md` | mock, spy, shouldRun, clearFake |
| `granular-traits.md` | Cherry-picking AsObject, AsController, etc. |
| `with-attributes.md` | WithAttributes trait, fill, validateAttributes |
| `use-unified-attributes.md` | Optional attributes, validateAttributes usage |
| `validation-and-auth.md` | authorize, rules, ActionRequest, validation hooks |
| `register-as-controller.md` | Route registration, routes(), registerRoutes |
| `dispatch-jobs.md` | Dispatching, chaining, batching, testing |
| `listen-for-events.md` | EventServiceProvider, Event::listen |
| `execute-as-commands.md` | Kernel, registerCommands, asCommand |
| `mock-and-test.md` | Mocking, spying, testing patterns |
| `how-does-it-work.md` | Decorators, container resolution (brief) |
| `checklist.md` | Common planning mistakes |
| `troubleshooting.md` | Diagnostic checks |

**Before finalizing**: Review `checklist.md` to catch common planning mistakes.
