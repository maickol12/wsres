<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd806512c9d77db6fa1ef470d3788e6f2
{
    public static $files = array (
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
        '5255c38a0faeba867671b61dfda6d864' => __DIR__ . '/..' . '/paragonie/random_compat/lib/random.php',
        '72579e7bd17821bb1321b87411366eae' => __DIR__ . '/..' . '/illuminate/support/helpers.php',
        '253c157292f75eb38082b5acb06f3f01' => __DIR__ . '/..' . '/nikic/fast-route/src/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Component\\Translation\\' => 30,
            'Slim\\' => 5,
        ),
        'P' => 
        array (
            'Psr\\Http\\Message\\' => 17,
            'Psr\\Container\\' => 14,
        ),
        'I' => 
        array (
            'Interop\\Container\\' => 18,
            'Illuminate\\Support\\' => 19,
            'Illuminate\\Database\\' => 20,
            'Illuminate\\Contracts\\' => 21,
            'Illuminate\\Container\\' => 21,
        ),
        'F' => 
        array (
            'FastRoute\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Component\\Translation\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/translation',
        ),
        'Slim\\' => 
        array (
            0 => __DIR__ . '/..' . '/slim/slim/Slim',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'Psr\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/container/src',
        ),
        'Interop\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/container-interop/container-interop/src/Interop/Container',
        ),
        'Illuminate\\Support\\' => 
        array (
            0 => __DIR__ . '/..' . '/illuminate/support',
        ),
        'Illuminate\\Database\\' => 
        array (
            0 => __DIR__ . '/..' . '/illuminate/database',
        ),
        'Illuminate\\Contracts\\' => 
        array (
            0 => __DIR__ . '/..' . '/illuminate/contracts',
        ),
        'Illuminate\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/illuminate/container',
        ),
        'FastRoute\\' => 
        array (
            0 => __DIR__ . '/..' . '/nikic/fast-route/src',
        ),
    );

    public static $fallbackDirsPsr4 = array (
        0 => __DIR__ . '/..' . '/nesbot/carbon/src',
    );

    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'Pimple' => 
            array (
                0 => __DIR__ . '/..' . '/pimple/pimple/src',
            ),
        ),
        'D' => 
        array (
            'Doctrine\\Common\\Inflector\\' => 
            array (
                0 => __DIR__ . '/..' . '/doctrine/inflector/lib',
            ),
        ),
    );

    public static $classMap = array (
        'Alumnos' => __DIR__ . '/../..' . '/models/Alumnos.php',
        'BancoProyectos' => __DIR__ . '/../..' . '/models/BancoProyectos.php',
        'Carreras' => __DIR__ . '/../..' . '/models/Carreras.php',
        'Documentos' => __DIR__ . '/../..' . '/models/Documentos.php',
        'Giros' => __DIR__ . '/../..' . '/models/Giros.php',
        'Mensajes' => __DIR__ . '/../..' . '/models/Mensajes.php',
        'Opciones' => __DIR__ . '/../..' . '/models/Opciones.php',
        'Periodos' => __DIR__ . '/../..' . '/models/Periodos.php',
        'ProyectoSeleccionado' => __DIR__ . '/../..' . '/models/ProyectoSeleccionado.php',
        'Sectores' => __DIR__ . '/../..' . '/models/Sectores.php',
        'Usuarios' => __DIR__ . '/../..' . '/models/Usuarios.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd806512c9d77db6fa1ef470d3788e6f2::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd806512c9d77db6fa1ef470d3788e6f2::$prefixDirsPsr4;
            $loader->fallbackDirsPsr4 = ComposerStaticInitd806512c9d77db6fa1ef470d3788e6f2::$fallbackDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitd806512c9d77db6fa1ef470d3788e6f2::$prefixesPsr0;
            $loader->classMap = ComposerStaticInitd806512c9d77db6fa1ef470d3788e6f2::$classMap;

        }, null, ClassLoader::class);
    }
}
