# Granular traits

`AsAction` is a composite of smaller traits:

```php
trait AsAction
{
    use AsObject;
    use AsController;
    use AsListener;
    use AsJob;
    use AsCommand;
    use AsFake;
}
```

## Cherry-picking

Use only the traits you need:

```php
class MyAction
{
    use AsObject;
    use AsController;
}
```

Or define a custom `AsAction` in your app that omits e.g. `AsCommand` or `AsListener`.

## When useful

- **Avoid conflicts**: e.g. you have your own `rules` method and never run as controller — use only `AsObject` and `AsJob`.
- **Slight performance**: Fewer patterns to check during container resolution.

For most actions, use the full `AsAction` trait.
