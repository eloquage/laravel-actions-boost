# Register as controller

## Route registration

Register the action as an invokable controller:

```php
Route::put('auth/password', UpdateUserPassword::class)->middleware('auth');
```

Or use `getControllerMiddleware()` on the action instead of (or in addition to) route middleware.

## `asController` vs `handle`

Implement **`asController`** to map the request to `handle`:

```php
public function asController(ActionRequest $request)
{
    $this->handle($request->user(), $request->get('password'));
    return redirect()->back();
}
```

If the action is **only** used as a controller, you can omit `asController` and use `handle(Request $request)` directly as the invokable. You then lose `MyAction::run(...)` style usage.

## JSON vs HTML

Use **`jsonResponse`** and **`htmlResponse`** to vary response by `Accept` type. They receive the return value of `asController` and the `Request`. See [as-controller.md].

## Routes on the action

Define **`routes(Router $router)`** on the action:

```php
public static function routes(Router $router): void
{
    $router->get('author/{author}/articles', static::class);
}
```

Call **`Actions::registerRoutes()`** (or `registerRoutes('app/Actions')` / multiple paths) in a service provider so Laravel Actions can discover and register these routes.

## Explicit methods

You can map a route to a specific method instead of the invokable:

```php
Route::get('articles/create', [CreateNewArticle::class, 'showForm']);
Route::post('articles', CreateNewArticle::class);
```

**No** authorization or validation runs automatically for explicit-method routes. Prefer separate actions (e.g. `ShowNewArticleForm`) when you need auth/validation on the form route.
