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

        $actions = collect(glob($directoryFromCalledClass . '/Actions/*.php'))->map(function ($file) {
            return lcfirst(str_replace('.php', '', basename($file)));
        })->toArray();

        if (!in_array($name, $actions)) {
            throw new Exception('Action not found');
        }

        return App::make($reflection->getNamespaceName() . '\\Actions\\' . ucfirst($name))->execute(...$arguments);
    }

    abstract public static function repository(): mixed;
}

