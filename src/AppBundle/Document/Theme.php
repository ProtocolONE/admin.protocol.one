<?php namespace AppBundle\Document;

use Application\Sonata\MediaBundle\Document\Media;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Theme
{
    /**
     * @var string
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @var string
     * @MongoDB\Field(type="string")
     */
    protected $name;

    /**
     * @var Media
     * @MongoDB\ReferenceOne(targetDocument="\Application\Sonata\MediaBundle\Document\Media", cascade={"all"})
     */
    protected $image;

    /**
     * @var Media
     * @MongoDB\ReferenceOne(targetDocument="\Application\Sonata\MediaBundle\Document\Media", cascade={"all"})
     */
    protected $file;

    /**
     * @var int
     * @MongoDB\Field(type="integer")
     */
    protected $size;

    /**
     * @var \DateTime
     * @MongoDB\Field(type="date")
     */
    protected $createDate;

    /**
     * @var \DateTime
     * @MongoDB\Field(type="date")
     */
    protected $updateDate;

    public function __construct()
    {
        $this->createDate = new \DateTime();
        $this->updateDate = new \DateTime();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return Theme
     */
    public function setId(string $id): Theme
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return (string)$this->name;
    }

    /**
     * @param string $name
     * @return Theme
     */
    public function setName(string $name): Theme
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Media
     */
    public function getImage(): ?Media
    {
        return $this->image;
    }

    /**
     * @param Media $image
     * @return Theme
     */
    public function setImage(Media $image): Theme
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return Media
     */
    public function getFile(): ?Media
    {
        return $this->file;
    }

    /**
     * @param Media $file
     * @return Theme
     */
    public function setFile(Media $file): Theme
    {
        $this->file = $file;
        return $this;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @param int $size
     * @return Theme
     */
    public function setSize(int $size): Theme
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreateDate(): \DateTime
    {
        return $this->createDate;
    }

    /**
     * @param \DateTime $createDate
     * @return Theme
     */
    public function setCreateDate(\DateTime $createDate): Theme
    {
        $this->createDate = $createDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdateDate(): \DateTime
    {
        return $this->updateDate;
    }

    /**
     * @param \DateTime $updateDate
     * @return Theme
     */
    public function setUpdateDate(\DateTime $updateDate): Theme
    {
        $this->updateDate = $updateDate;
        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
