<?php
/**
 * Default console output class for Config Api.
 *
 * @category PHP
 * @package  PHP_Reflect
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  GIT: $Id$
 * @link     http://php5.laurent-laville.org/reflect/
 */

namespace Bartlett\Reflect\Output;

use Bartlett\Reflect\Environment;
use Bartlett\Reflect\Console\Formatter\OutputFormatter;

use Symfony\Component\Console\Output\OutputInterface;

/**
 * Config results default render on console
 *
 * @category PHP
 * @package  PHP_Reflect
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/reflect/
 * @since    Class available since Release 3.0.0-alpha1
 */
class Config extends OutputFormatter
{
    /**
     * Config validate results
     *
     * @param OutputInterface $output   Console Output concrete instance
     * @param array           $response Render config:validate command
     */
    public function validate(OutputInterface $output, $response)
    {
        $output->writeln(
            sprintf(
                '<info>"%s" config file is valid</info>',
                Environment::getJsonConfigFilename()
            )
        );
    }
}
