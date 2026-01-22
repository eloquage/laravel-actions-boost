# Validation and authorization

When running as a **controller**, use `Lorisleiva\Actions\ActionRequest` instead of `Illuminate\Http\Request` to drive validation and authorization from the action.

## `ActionRequest`

Inject `ActionRequest` in `asController`:

```php
public function asController(ActionRequest $request)
{
    // Authorization and validation already run.
    $this->handle($request->user(), $request->validated());
}
```

The request delegates to methods on the action. Alternatively, use a custom `FormRequest` and inject that; validation then lives in the FormRequest, not the action.

## Authorization

**`authorize(ActionRequest $request): bool`**

Return `true` to allow, `false` to deny. Can use `$request->user()->can(...)`, `Gate::check(...)`, etc. You may return `Illuminate\Auth\Access\Response` (e.g. `Response::deny('message')`). Override **`getAuthorizationFailure()`** to customise the exception.

## Validation

- **`rules(): array`**: Validation rules.
- **`prepareForValidation(ActionRequest $request): void`**: Mutate request before validation.
- **`withValidator(Validator $validator, ActionRequest $request): void`**: Add custom logic (e.g. `$validator->after(...)`).
- **`afterValidator(Validator $validator, ActionRequest $request): void`**: Simpler “after” callback without nesting.
- **`getValidator(Factory $factory, ActionRequest $request): Validator`**: Full control; overrides `rules`, `withValidator`, `afterValidator`.
- **`getValidationData(ActionRequest $request): array`**: Data to validate (default `$request->all()`).
- **`getValidationMessages()`**, **`getValidationAttributes()`**: Messages and attribute names.
- **`getValidationRedirect(UrlGenerator $url): string`**, **`getValidationErrorBag(): string`**: Redirect and error bag on failure.
- **`getValidationFailure(): void`**: Override validation exception.

Auth/validation run only when the action is used as a controller (or when using `WithAttributes` + `validateAttributes`). See [as-controller.md], [register-as-controller.md].
