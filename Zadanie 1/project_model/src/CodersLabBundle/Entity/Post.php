<?php

namespace CodersLabBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="posts")
 */

class Post
{
  /**
   * @ORM\id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue
   */

  private $id;

  /**
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue
   */

  private $title;

  /**
   * @ORM\Column(type="text")
   */

  private $text;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param integer $title
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return integer
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set text
     *
     * @param string $text
     * @return Post
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }
}
