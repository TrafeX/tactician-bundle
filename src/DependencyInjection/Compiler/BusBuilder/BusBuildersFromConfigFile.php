<?php
declare(strict_types=1);

namespace League\Tactician\Bundle\DependencyInjection\Compiler\BusBuilder;

final class BusBuildersFromConfigFile
{
    public static function convert(array $config): BusBuilders
    {
        $defaultInflector = $config['method_inflector'] ?? 'tactician.handler.method_name_inflector.handle';

        $builders = [];
        foreach ($config['commandbus'] as $busId => $busConfig) {
            $builders[] = new BusBuilder(
                $busId,
                $busConfig['method_inflector'] ?? $defaultInflector,
                $busConfig['middleware']
            );
        }

        return new BusBuilders($builders, $config['default_bus'] ?? 'default');
    }
}