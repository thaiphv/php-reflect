<?php
/**
 * Common formatter class for console output.
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_Reflect
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  GIT: $Id$
 * @link     http://php5.laurent-laville.org/reflect/
 */

namespace Bartlett\Reflect\Console\Formatter;

use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Formatter\OutputFormatter as BaseOutputFormatter;

/**
 * Common formatter helpers for console output.
 *
 * @category PHP
 * @package  PHP_Reflect
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/reflect/
 * @since    Class available since Release 3.0.0-alpha1
 */
class OutputFormatter extends BaseOutputFormatter
{
    /**
     * Helper that convert analyser results to a console table
     *
     * @param OutputInterface $output  Console Output concrete instance
     * @param array           $headers All table headers
     * @param array           $rows    All table rows
     * @param string          $style   The default style name to render tables
     *
     * @return void
     */
    protected function tableHelper(OutputInterface $output, $headers, $rows, $style = 'compact')
    {
        $table = new Table($output);
        $table->setStyle($style)
            ->setHeaders($headers)
            ->setRows($rows)
            ->render()
        ;
    }

    /**
     * Helper that convert an array key-value pairs to a console report.
     *
     * See Structure and Loc analysers for implementation examples
     *
     * @param OutputInterface $output Console Output concrete instance
     * @param array           $lines  Any analyser formatted metrics
     *
     * @return void
     */
    protected function printFormattedLines(OutputInterface $output, array $lines)
    {
        foreach ($lines as $ident => $contents) {
            list ($format, $args) = $contents;
            $output->writeln(vsprintf($format, $args));
        }
    }
}
