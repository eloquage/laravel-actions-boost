# Listen for events

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

## `asListener`

Map event payload to `handle`:

```php
public function asListener(TaxiRequested $event): void
{
    $this->handle($event->source, $event->destination);
}
```

For **string events**, `asListener` receives the event parameters as arguments. You can listen to multiple events and branch inside `asListener`.

## Queueable listeners

Add **`implements \Illuminate\Contracts\Queue\ShouldQueue`** to the action to run the listener as a queued job. Ensure your queue driver is configured.

See [as-listener.md].
