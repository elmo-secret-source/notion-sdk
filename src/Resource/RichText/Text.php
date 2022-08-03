<?php

declare(strict_types=1);

namespace Brd6\NotionSdkPhp\Resource\RichText;

use Brd6\NotionSdkPhp\Resource\Annotations;
use Brd6\NotionSdkPhp\Resource\Link;
use Brd6\NotionSdkPhp\Resource\Property\TextProperty;

class Text extends AbstractRichText
{
    public const RICH_TEXT_TYPE = 'text';
    protected ?TextProperty $text = null;

    public function __construct()
    {
        $this->type = self::RICH_TEXT_TYPE;
    }

    public static function fromContent(string $content): self
    {
        $text = new self();
        $text->annotations = new Annotations();

        return $text->setText((new TextProperty())->setContent($content));
    }

    public static function fromContentLink(string $content, string $link): self
    {
        $text = new self();
        $text->annotations = new Annotations();

        $textProperty = (new TextProperty())
            ->setContent($content)
            ->setLink((new Link())->setUrl($link)->setType('url'));

        $text->setText($textProperty);

        return $text;
    }

    protected function initialize(): void
    {
        $data = (array) $this->getRawData()[$this->getType()];
        $this->text = TextProperty::fromRawData($data);
    }

    public function getText(): ?TextProperty
    {
        return $this->text;
    }

    public function setText(?TextProperty $text): self
    {
        $this->text = $text;

        return $this;
    }
}
