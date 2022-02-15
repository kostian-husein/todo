<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExampleTable
 *
 * @ORM\Table(name="example_table")
 * @ORM\Entity
 */
class ExampleTable
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string|null
     *
     * @ORM\Column(name="test_column", type="string", length=255, nullable=true)
     */
    private $testColumn;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    private $date;


}
