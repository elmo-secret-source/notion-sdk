<?php

declare(strict_types=1);

namespace Brd6\NotionSdkPhp\Resource\Property;

use Brd6\NotionSdkPhp\Exception\UnsupportedUserTypeException;

class BotProperty extends AbstractProperty
{
    protected ?OwnerProperty $owner = null;

    /**
     * @throws UnsupportedUserTypeException
     */
    public static function fromRawData(array $rawData): self
    {
        $property = new self();

        if (empty($rawData)) {
            return $property;
        }

        $property->owner = OwnerProperty::fromRawData((array) $rawData['owner']);

        return $property;
    }

    public function getOwner(): ?OwnerProperty
    {
        return $this->owner;
    }

    public function setOwner(OwnerProperty $owner): self
    {
        $this->owner = $owner;

        return $this;
    }
}
