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
  private $text;
}





 ?>
