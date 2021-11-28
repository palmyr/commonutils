<?php declare(strict_types=1);

namespace Palmyr\CommonUtils\InternetProtocol\Builder;

use Palmyr\CommonUtils\InternetProtocol\Exception\ValidationException;

abstract class AbstractBuilder
{

    public const IPV4_PATTERN = '^(\d+)\.(\d+)\.(\d+)\.(\d+)$';

    /**
     * @param string $ipv4
     * @throws ValidationException
     */
    protected function validateIPV4(string $ipv4): void
    {
        if ( preg_match('/'.self::IPV4_PATTERN.'/', $ipv4, $matches) ) {
            reset($matches);
            foreach ( $matches as $piece ) {
                $piece = (int)$piece;
                if ( $piece < 0 || $piece > 255 ) {
                    throw new ValidationException('The provided ipv4 is out of range');
                }
            }

            return;
        }

        throw new ValidationException('The provided ipv4 is not correctly formatted');
    }
}