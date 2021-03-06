<?php
/**
 * Default console output class for Reflection Api.
 *
 * @category PHP
 * @package  PHP_Reflect
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  GIT: $Id$
 * @link     http://php5.laurent-laville.org/reflect/
 */

namespace Bartlett\Reflect\Output;

use Bartlett\Reflect\Console\Formatter\OutputFormatter;

use Symfony\Component\Console\Output\OutputInterface;

/**
 * Reflection results default render on console
 *
 * @category PHP
 * @package  PHP_Reflect
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/reflect/
 * @since    Class available since Release 3.0.0-alpha1
 */
class Reflection extends OutputFormatter
{
    /**
     * Class Reflection results
     *
     * @param OutputInterface $output   Console Output concrete instance
     * @param array           $response Results of User Class Reflection
     *
     * @return void
     */
    public function class_(OutputInterface $output, $response)
    {
        $output->writeln((string) $response);
    }

    /**
     * Function Reflection results
     *
     * @param OutputInterface $output   Console Output concrete instance
     * @param array           $response Results of User Function Reflection
     *
     * @return void
     */
    public function function_(OutputInterface $output, $response)
    {
        $output->writeln((string) $response);
    }
}
