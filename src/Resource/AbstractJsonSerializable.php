<?php

declare(strict_types=1);

namespace Brd6\NotionSdkPhp\Resource;

use Brd6\NotionSdkPhp\Util\ArrayHelper;
use JsonSerializable;

use function array_filter;
use function count;
use function get_object_vars;
use function in_array;
use function is_array;
use function json_decode;
use function json_encode;

use const ARRAY_FILTER_USE_BOTH;

abstract class AbstractJsonSerializable implements JsonSerializable
{
    private const EXCLUDED_KEYS = ['ignoreEmptyValue', 'rawData', 'onlyKeys'];

    private bool $ignoreEmptyValue = true;
    private array $onlyKeys = [];

    public function jsonSerialize(): array
    {
        return array_filter(
            get_object_vars($this),
            fn ($value, string $key) => $this->canBeSerialized($value, $key),
            ARRAY_FILTER_USE_BOTH,
        );
    }

    public function toArray(bool $ignoreEmptyValue = true, array $onlyKeys = []): array
    {
        $this->ignoreEmptyValue = $ignoreEmptyValue;
        $this->onlyKeys = $onlyKeys;

        /** @var array $data */
        $data = json_decode((string) json_encode($this), true);
        ArrayHelper::transformKeysToSnakeCase($data);

        $this->onlyKeys = [];

        return $data;
    }

    /**
     * @param mixed $value
     */
    protected function canBeSerialized($value, string $key): bool
    {
        return ((count($this->onlyKeys) === 0 || in_array($key, $this->onlyKeys)) &&
                !in_array($key, self::EXCLUDED_KEYS)) &&
            (!$this->ignoreEmptyValue ||
            (($value !== null && $value !== '') &&
                ((!is_array($value)) || count($value) > 0)
            ));
    }
}
