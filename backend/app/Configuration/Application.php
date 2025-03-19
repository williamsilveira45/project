<?php
declare(strict_types=1);

namespace App\Configuration;

use Illuminate\Foundation\Application as FoundationApplication;

class Application extends FoundationApplication
{
    /**
     * The modules are marked for registration.
     *
     * @var array
     */
    public array $modules = [];

    /**
     * Begin configuring a new Laravel application instance.
     *
     * @param  string|null  $basePath
     * @return ApplicationBuilder
     */
    public static function configure(?string $basePath = null)
    {
        $basePath = match (true) {
            is_string($basePath) => $basePath,
            default => static::inferBasePath(),
        };

        return (new ApplicationBuilder(new static($basePath)))
            ->withKernels()
            ->withEvents()
            ->withCommands()
            ->withProviders()
            ->withModules();
    }

    /**
     * @return array
     */
    public function getModules(): array
    {
        return $this->modules;
    }
}
