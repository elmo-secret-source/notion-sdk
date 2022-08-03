<?php

declare(strict_types=1);

namespace Brd6\NotionSdkPhp\Exception;

use function sprintf;
use function strlen;

class InvalidResourceTypeException extends AbstractNotionException
{
    public const MESSAGE = 'The given object "%s" is invalid.';

    public function __construct(string $type, string $message = '')
    {
        $message = strlen($message) > 0 ? $message : sprintf(self::MESSAGE, $type);

        parent::__construct($message);
    }

    public function getMessageCode(): string
    {
        return '';
    }
}
