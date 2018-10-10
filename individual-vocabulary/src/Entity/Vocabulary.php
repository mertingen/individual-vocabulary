<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VocabularyRepository")
 */
class Vocabulary implements \JsonSerializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $foreignWord;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $knownMean;

    /**
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="vocabularies")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getForeignWord(): ?string
    {
        return $this->foreignWord;
    }

    public function setForeignWord(string $foreignWord): self
    {
        $this->foreignWord = $foreignWord;

        return $this;
    }

    public function getKnownMean(): ?string
    {
        return $this->knownMean;
    }

    public function setKnownMean(string $knownMean): self
    {
        $this->knownMean = $knownMean;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return array(
            'id' => $this->getId(),
            'foreignWord' => $this->getForeignWord(),
            'knownMean' => $this->getKnownMean()
        );
    }
}
