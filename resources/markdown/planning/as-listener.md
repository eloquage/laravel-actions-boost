# As listener

Actions can run as event listeners. Use `Lorisleiva\Actions\Concerns\AsListener` (included in `AsAction`).

## `asListener`

Called when the event is dispatched. Map event data to `handle` arguments.

```php
public function asListener(TaxiRequested $event): void
{
    $this->handle($event->source, $event->destination);
}
```

For string events, `asListener` receives event parameters as arguments. You can listen to multiple events and branch inside `asListener`.

## Registration

**EventServiceProvider** `$listen`:

```php
protected $listen = [
    TaxiRequested::class => [SendOfferToNearbyDrivers::class],
];
```

**Event facade**:

```php
Event::listen(TaxiRequested::class, SendOfferToNearbyDrivers::class);
Event::listen('taxi.requested.*', MyAction::class);
```

## Queueable listener

Implement `Illuminate\Contracts\Queue\ShouldQueue` on the action to run the listener as a queued job.

See [listen-for-events.md].
