<?php

/*
 * This file is part of the BluemesaStorageBundle.
 * 
 * Copyright (c) 2016 BlueMesa LabDB Contributors <labdb@bluemesa.eu>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bluemesa\Bundle\StorageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use Bluemesa\Bundle\CoreBundle\Entity\Entity;


/**
 * RackPosition class
 *
 * @ORM\MappedSuperclass
 *
 * @author Radoslaw Kamil Ejsmont <radoslaw@ejsmont.net>
 */
abstract class RackPosition extends Entity implements RackPositionInterface
{
    use RackPositionTrait;
    
    /**
     * Construct RackPosition
     *
     * @param Bluemesa\Bundle\StorageBundle\Entity\RackInterface   $rack
     * @param integer|string                                $row
     * @param integer                                       $column
     */
    public function __construct(RackInterface $rack, $row, $column)
    {
        $this->setRack($rack);
        $this->setRow($row);
        $this->setColumn($column);
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return (string) $this->getRack() . ' ' . $this->getRow() . sprintf("%02d",$this->getColumn());
    }
}
