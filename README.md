<h1>Laravel ChatGPT</h1>
<h3>Application Laravel integrated with OpenAI's ChatGPT, with Authentication and Cache.</h3>
<p>In this project, we have a Laravel 9 application with PHP 8.2, with a login session and access to OpenAI's ChatGPT API, in addition, there is a cache application to avoid the consumption of recently performed queries.
The entire Laravel project also has TailwindCSS themes, Vite.js to compile scripts, docker-compose file with PHP 8.2, MySQL and Redis. Furthermore, the entire project runs easily with Laravel Sail, requiring only a docker environment to run.</p>
<h1>Get Started</h1>
<h4>Required:</h4>

-   PHP 8.1+
-   Docker
-   WSL2 (recommended)
-   OpenAI account for API Key

<h4>Installation</h4>

-   Clone this repository
-   Run `composer update`
-   Into folder, run `./vendor/bin/sail build`
-   After build, run `./vendor/bin/sail up -d`
-   Done, access on browser `http://localhost`

<h1>Tutorial<h1>
...

<h1>How this project was made!</h1>

-   Create a new project with Laravel Sail template

```bash
curl -s "https://laravel.build/example-app?with=mysql,redis" | bash
```

-   Running the project with Laravel Sail

```bash
sail up -d
```

-   Require laravel breeze for gerante auth sessions pages

```bash
composer require laravel/breeze --dev
```

-   Install Laravel Breeze, apply generate auth session pages on project

```bash
php artisan breeze:install
```

-   Run all migrations, including migrations of breeze

```bash
php artisan migrate
```

-   Install npm dependencies

```bash
npm install
```

-   Run npm to test application are stared

```bash
npm run dev
```

-   If your application not found scripts will be set configuration into ./vite.config.js file add after `plugins: [...]`

```js
    watch: {
        usePolling: true,
        origin: 'http://localhost'
    },
    server: {
        hmr: {
            host: 'localhost'
        }
    }
```

-   To add authentication session on application

```bash
php artisan breeze:install --dark
```

-   Install Nuno Maduro dependencies for supporting at OpenAI, with all api resources.

```bash
composer require openai-php/client
```

-   Add into .env OpenAI key

```bash
echo -e '\nOPEN_AI_KEY="CHANGE_TO_YOUR_KEY..."' >> .env
```

-   Genertate OpenAIController

```bash
sail artisan make:controller OpenAIController
```

-   Run again NPM for auto builds scripts after changes

```bash
npm run dev
```

-   New Route on web.php file, into session auth, add route:

```php
    Route::get('/openai', [OpenAIController::class, 'index'])->name('openai.index');
```

-   New Link for menu access, on file ./resources/views/layouts/navigation.blade.php add:

    ```html
    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-nav-link
            :href="route('openai.index')"
            :active="request()->routeIs('openai.index')"
        >
            {{ __('OpenAI') }}
        </x-nav-link>
    </div>
    ```

-   New file ./app/Http/Controllers/OpenAIController.php

-   New file ./resources/views/openai/index.blade.php

<h1>Inspirations</h1>

-   About OpenAI models

[Openai Models](https://beta.openai.com/docs/models/gpt-3)

-   OpenAI-PHP Dependencies

[Nuno Maduro - OpenAI-PHP dependecy](https://github.com/openai-php/client)

-   OpenAI ChatGPT

[OpenAI ChatGTP](https://openai.com/blog/chatgpt/)

-   App Node.js with ChatGPT and WhatsApp

[Victor Harray - Guide integration ChatGPT with WhatsApp](https://medium.com/@victorhcharry/guia-completo-de-como-integrar-o-gpt-com-whatsapp-da9040341859)
