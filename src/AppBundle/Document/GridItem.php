<?php namespace AppBundle\Document;

use Application\Sonata\MediaBundle\Document\Media;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class GridItem
{
    /**
     * @var string
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @var Game
     * @MongoDB\ReferenceOne(targetDocument="Game")
     */
    protected $game;

    /**
     * @var Media
     * @MongoDB\ReferenceOne(targetDocument="\Application\Sonata\MediaBundle\Document\Media", cascade={"all"})
     */
    protected $image;

    /**
     * @var int
     * @MongoDB\Field(type="integer")
     */
    protected $row;

    /**
     * @var int
     * @MongoDB\Field(type="integer")
     */
    protected $col;

    /**
     * @var int
     * @MongoDB\Field(type="integer")
     */
    protected $width;

    /**
     * @var int
     * @MongoDB\Field(type="integer")
     */
    protected $height;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return GridItem
     */
    public function setId($id): GridItem
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Game
     */
    public function getGame(): Game
    {
        return $this->game;
    }

    /**
     * @param Game $game
     * @return GridItem
     */
    public function setGame($game): GridItem
    {
        $this->game = $game;
        return $this;
    }

    /**
     * @return Media
     */
    public function getImage(): Media
    {
        return $this->image;
    }

    /**
     * @param Media $image
     * @return GridItem
     */
    public function setImage($image): GridItem
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return int
     */
    public function getRow(): int
    {
        return $this->row;
    }

    /**
     * @param int $row
     * @return GridItem
     */
    public function setRow($row): GridItem
    {
        $this->row = $row;
        return $this;
    }

    /**
     * @return int
     */
    public function getCol(): int
    {
        return $this->col;
    }

    /**
     * @param int $col
     * @return GridItem
     */
    public function setCol($col): GridItem
    {
        $this->col = $col;
        return $this;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @param int $width
     * @return GridItem
     */
    public function setWidth($width): GridItem
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @param int $height
     * @return GridItem
     */
    public function setHeight($height): GridItem
    {
        $this->height = $height;
        return $this;
    }

    public function __toString()
    {
        return sprintf(
            '%s (row %d | col %d) %dx%d',
            $this->getGame()->getName(),
            $this->getRow(),
            $this->getCol(),
            $this->getWidth(),
            $this->getWidth()
        );
    }
}
