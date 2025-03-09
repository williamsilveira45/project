<?php
declare(strict_types=1);

namespace App\Modules;

use Exception;
use Illuminate\Support\Facades\App;
use ReflectionClass;

abstract class AbstractModule
{
    public static function __callStatic(string $name, array $arguments): mixed
    {
        $calledClass = get_called_class();
        $reflection = new ReflectionClass($calledClass);

        $directoryFromCalledClass = dirname($reflection->getFileName());

        $files = collect([
            glob($directoryFromCalledClass . '/Actions/*.php'),
            glob($directoryFromCalledClass . '/Actions/*/*.php')
        ])->flatten();

        //remove from array the internal actions
        $files = $files->filter(function ($file) {
            //@todo improve this logic
            return !str_contains($file, 'Internal');
        });

        $action = $files->map(function ($file) {
            //search for word 'Actions' and get the string after it
            $file = substr($file, strpos($file, 'Actions') + 8);
            return str_replace('.php', '', $file);
        })->filter(function ($file) use ($name) {
            return str_contains(strtolower($file), strtolower($name));
        })->first();

        if (empty($action)) {
            throw new Exception('Action not found');
        }

        $action = str_replace('/', '\\', $action);

        return App::make($reflection->getNamespaceName() . '\\Actions\\' . $action)->execute(...$arguments);
    }

    abstract public static function repository(): mixed;
}

