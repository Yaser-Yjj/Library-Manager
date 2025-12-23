<?php

use CodeIgniter\Boot;
use Config\Paths;

require __DIR__ . '/app/Config/Paths.php';

define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR);

class preload
{
    private array $paths = [
        [
            'include' => __DIR__ . '/vendor/codeigniter4/framework/system',
            'exclude' => [
                '/system/Database/OCI8/',
                '/system/Database/Postgre/',
                '/system/Database/SQLite3/',
                '/system/Database/SQLSRV/',
                '/system/Database/Seeder.php',
                '/system/Test/',
                '/system/CLI/',
                '/system/Commands/',
                '/system/Publisher/',
                '/system/ComposerScripts.php',
                '/system/Config/Routes.php',
                '/system/Language/',
                '/system/bootstrap.php',
                '/system/util_bootstrap.php',
                '/system/rewrite.php',
                '/Views/',
                '/system/ThirdParty/',
            ],
        ],
    ];

    public function __construct()
    {
        $this->loadAutoloader();
    }

    private function loadAutoloader(): void
    {
        $paths = new Paths();
        require rtrim($paths->systemDirectory, '\\/ ') . DIRECTORY_SEPARATOR . 'Boot.php';

        Boot::preload($paths);
    }

    public function load(): void
    {
        foreach ($this->paths as $path) {
            $directory = new RecursiveDirectoryIterator($path['include']);
            $fullTree  = new RecursiveIteratorIterator($directory);
            $phpFiles  = new RegexIterator(
                $fullTree,
                '/.+((?<!Test)+\.php$)/i',
                RecursiveRegexIterator::GET_MATCH,
            );

            foreach ($phpFiles as $key => $file) {
                foreach ($path['exclude'] as $exclude) {
                    if (str_contains($file[0], $exclude)) {
                        continue 2;
                    }
                }

                require_once $file[0];
            }
        }
    }
}

(new preload())->load();
