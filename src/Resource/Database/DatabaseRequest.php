<?php

declare(strict_types=1);

namespace Brd6\NotionSdkPhp\Resource\Database;

use Brd6\NotionSdkPhp\Resource\AbstractJsonSerializable;

class DatabaseRequest extends AbstractJsonSerializable
{
    protected array $filter = [];
    protected array $sorts = [];
    protected ? string $startCursor = null;

    public function getFilter(): array
    {
        return $this->filter;
    }

    public function setFilter(array $filter): self
    {
        $this->filter = $filter;

        return $this;
    }

    public function getSorts(): array
    {
        return $this->sorts;
    }

    public function setSorts(array $sorts): self
    {
        $this->sorts = $sorts;

        return $this;
    }

    public function getStartCursor(): string
    {
        return $this->startCursor;
    }

    public function setStartCursor(string $startCursor): self
    {
        $this->startCursor = $startCursor;

        return $this;
    }
}
