# Use unified attributes

Optional **unified attributes** let you validate the same data whether the action runs as an object or as a controller.

## Setup

Use `AsAction` and `WithAttributes`. Fill attributes from the caller or from the request:

```php
// As object
$this->fill($attributes);

// As controller
$this->fillFromRequest($request);
```

## `validateAttributes`

Call `$this->validateAttributes()` to run `authorize` and `rules` (and `withValidator`, etc.) against the current attributes. Returns validated data.

When using `WithAttributes`, **controller requests are not auto-validated**. Use either:

- `$this->validateAttributes()` in the action, or
- `$request->validate()` in `asController` when you still use `rules` etc.

## Example

```php
class PublishNewArticle
{
    use AsAction;
    use WithAttributes;

    public function authorize(): bool
    {
        return $this->author->can('publish-new-articles');
    }

    public function rules(): array
    {
        return ['title' => ['required'], 'body' => ['required', 'min:100']];
    }

    public function handle(User $author, array $attributes = []): Article
    {
        $this->set('author', $author)->fill($attributes);
        $validated = $this->validateAttributes();
        return $author->articles()->create($validated);
    }

    public function asController(ActionRequest $request): Article
    {
        $this->fillFromRequest($request);
        return $this->handle($request->user());
    }
}
```

Design your `handle` API first (explicit args vs array); then wire `asController` via `fillFromRequest` and `handle`.
