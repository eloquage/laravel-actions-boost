# With attributes

`Lorisleiva\Actions\Concerns\WithAttributes` is **not** included in `AsAction`. Add it explicitly when you want attribute-backed data.

## Usage

```php
use Lorisleiva\Actions\Concerns\AsAction;
use Lorisleiva\Actions\Concerns\WithAttributes;

class MyAction
{
    use AsAction;
    use WithAttributes;
}
```

## Methods

- **`setRawAttributes(array)`**: Replace all attributes.
- **`fill(array)`**: Merge with existing attributes.
- **`fillFromRequest(Request)`**: Merge request data and route parameters (request overrides route).
- **`all()`**, **`only(...keys)`**, **`except(...keys)`**: Read attributes.
- **`has($key)`**, **`get($key, $default = null)`**, **`set($key, $value)`**: Single attribute.
- Magic **`__get`** / **`__set`** / **`__isset`**: e.g. `$action->title`, `$action->title = 'x'`.

## `validateAttributes`

Triggers authorization and validation using the same hooks as controller validation (`authorize`, `rules`, `withValidator`, etc.). Returns validated data.

When using `WithAttributes`, the action does **not** automatically validate `ActionRequest` in `asController`. Call `$request->validate()` manually if needed, or use `validateAttributes` on the action.

See [use-unified-attributes.md] and [validation-and-auth.md].
