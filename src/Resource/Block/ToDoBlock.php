<?php

declare(strict_types=1);

namespace Brd6\NotionSdkPhp\Resource\Block;

use Brd6\NotionSdkPhp\Exception\InvalidResourceException;
use Brd6\NotionSdkPhp\Exception\InvalidResourceTypeException;
use Brd6\NotionSdkPhp\Exception\InvalidRichTextException;
use Brd6\NotionSdkPhp\Exception\UnsupportedRichTextTypeException;
use Brd6\NotionSdkPhp\Resource\Property\ToDoProperty;

class ToDoBlock extends AbstractBlock
{
    protected ?ToDoProperty $toDo = null;

    /**
     * @throws InvalidResourceException
     * @throws InvalidResourceTypeException
     * @throws InvalidRichTextException
     * @throws UnsupportedRichTextTypeException
     */
    protected function initializeBlockProperty(): void
    {
        $data = (array) $this->getRawData()[$this->getType()];
        $this->toDo = ToDoProperty::fromRawData($data);
    }

    public function getToDo(): ?ToDoProperty
    {
        return $this->toDo;
    }

    public function setToDo(?ToDoProperty $toDo): self
    {
        $this->toDo = $toDo;

        return $this;
    }
}
