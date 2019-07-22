# laravel-support
This library contains common funtionality that I use across many Laravel
applications. I think some of this stuff belongs in the framework, but
what do I know?

Installation is simple:

```
composer require bram1028/laravel-support
```

The service provider will be loaded automatically.

---

## @optional
Checks if a section has content, so you can wrap a yield in other code.

```html
@optional('hero')
    <div class="hero">
        <div class="hero-body">
            @yield('hero')
        </div>
    </div>
@endoptional
```

## Route::if()
Makes styling active nav links much cleaner.

```html
<ul>
    <li class="{!! Route::if('about', 'is-active') !!}">
        <a href="{{ route('about') }}">About Us</a>
    </li>
</ul>
```

And yes, you can pass multiple route names. The last parameter is used as the
output value.
