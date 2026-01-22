# As controller

Actions can run as invokable controllers. Use `Lorisleiva\Actions\Concerns\AsController` (included in `AsAction`).

## `asController`

Called when the action is used as a controller. Receives route-model-bound parameters and the request. If omitted, the decorator calls `handle` directly.

```php
use Illuminate\Http\Request;
use Lorisleiva\Actions\ActionRequest;

public function asController(User $user, ActionRequest $request): \Illuminate\Http\Response
{
    $this->handle($user, $request->get('password'));
    return redirect()->back();
}
```

Use **`ActionRequest`** (not `Request`) when you want validation and authorization defined on the action. See [validation-and-auth.md] and [register-as-controller.md].

## `jsonResponse` / `htmlResponse`

Return different responses for JSON vs HTML. Both receive the return value of `asController` and the `Request`.

```php
public function jsonResponse(Article $article, Request $request): ArticleResource
{
    return new ArticleResource($article);
}

public function htmlResponse(Article $article, Request $request): \Illuminate\Http\RedirectResponse
{
    return redirect()->route('articles.show', $article);
}
```

## `getControllerMiddleware`

Attach middleware when used as a controller.

```php
public function getControllerMiddleware(): array
{
    return ['auth', 'throttle:10'];
}
```

## `routes`

Define routes on the action. Requires `Actions::registerRoutes()`. See [register-as-controller.md].

## Validation and authorization

When using `ActionRequest`, implement `authorize`, `rules`, `withValidator`, `afterValidator`, etc. on the action. See [validation-and-auth.md].
