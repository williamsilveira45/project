<?php
declare(strict_types=1);

namespace App\Configuration;

use Illuminate\Foundation\Configuration\ApplicationBuilder as ConfigurationApplicationBuilder;

class ApplicationBuilder extends ConfigurationApplicationBuilder
{
    /**
     * Register the modules.
     *
     * @param  array  $modules e.g. ['Core' => 'App\Modules\Core\CoreModule', 'Notification' => 'App\Modules\Notifications\NotificationModule']
     * @return $this
     */
    public function withModules(array $modules = []): static
    {
        if (empty($modules)) {
            // search for modules in the app/Modules directory
            $pathFunction = function ($path) {
                $basePath = app_path();
                $filePathWithoutExtension = str_replace('.php', '', $path);
                $path = 'App' . str_replace($basePath, '', $filePathWithoutExtension);
                $classPath = str_replace('/', '\\', $path);
                $key = str_replace('Module', '', class_basename($classPath));
                return [$key => $classPath];
            };

            $files = glob(app_path('Modules/*/*Module.php'));
            $modules = [];
            foreach ($files as $file) {
                $modules = array_merge($modules, $pathFunction($file));
            }
        }

        $this->app->modules = $modules;

        return $this;
    }
}
