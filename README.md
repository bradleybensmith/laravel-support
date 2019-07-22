# laravel-support
This library contains common funtionality that I use across many Laravel
applications. I think some of this stuff belongs in the framework, but
what do I know?

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
