<?php

namespace Bartlett\Reflect\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Finder\Finder;

class ProviderCommand extends Command
{
    protected $source;
    protected $finder;

    /**
     * Find any provider that match optional criteria $source or $alias
     *
     * @param array  $provider    Current provider to lookup
     * @param string $source      Data source path
     * @param string $alias       Alias of a data source
     * @param bool   $constraints (optional) With or without defined constraints.
     *                            Default with constraints.
     *
     * @return bool TRUE if provider found, FALSE otherwise
     */
    protected function findProvider($provider, $source, $alias, $constraints = true)
    {
        if (!isset($provider['in'])) {
            // this source provider is incomplete: missing "in" key
            return false;
        }
        $in = trim($provider['in']);
        if (empty($in)) {
            // this source provider is incomplete: empty "in" key
            return false;
        }
        $src = explode(' as ', $in);
        $src = array_map('trim', $src);

        if ($source) {
            if (!empty($alias) && count($src) < 2) {
                // searching on alias, which is not provided
                return false;
            }
            $i = empty($alias) ? 0 : 1;
            // search on data source path ($i = 0) or alias ($i = 1)
            if ($src[$i] !== $source) {
                return false;
            }
        }

        if (substr($src[0], 0, 1) == '.') {
            // relative local file
            $src[0] = realpath($src[0]);

            if (PATH_SEPARATOR == ';') {
                // normalizes path to unix format
                $src[0] = str_replace(DIRECTORY_SEPARATOR, '/', substr($src[0], 2));
            }
        }

        // found it
        $finder = new Finder();
        $finder->files()
            ->in($src[0])
        ;

        if (count($src) == 1) {
            // if alias not provided, give empty value
            $src[] = '';
        }

        $this->source = $src;
        $this->finder = $finder;

        if (!$constraints) {
            return true;
        }

        $constraints = array(
            'name', 'notName',          // File name constraints
            'path', 'notPath',          // Path constraints
            'size',                     // File size constraints
            'date',                     // File date constraints
            'depth',                    // Directory depth constraints
            'contains', 'notContains',  // File contents constraints
        );
        foreach ($constraints as $constraint) {
            if (isset($provider[$constraint])) {
                if (is_array($provider[$constraint])) {
                    $args = $provider[$constraint];
                } else {
                    $args = array($provider[$constraint]);
                }
                foreach ($args as $arg) {
                    $finder->{$constraint}($arg);
                }
            }
        }
        return true;
    }
}
