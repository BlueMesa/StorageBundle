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

use Doctrine\Common\Collections\ArrayCollection;
use Bluemesa\Bundle\CoreBundle\Entity\Entity;

/**
 * Rack class
 *
 * @ORM\MappedSuperclass
 *
 * @author Radoslaw Kamil Ejsmont <radoslaw@ejsmont.net>
 */
abstract class Rack extends Entity implements RackInterface
{
    use RackTrait;
    
    /**
     * Construct Rack
     *
     * @param integer  $rows
     * @param integer  $columns
     */
    public function __construct($rows = null, $columns = null)
    {
        $this->{$this->getPositionsProperty()} = new ArrayCollection();
        $this->setGeometry($rows, $columns);
    }
    
    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return sprintf("R%06d",$this->getId());
    }
}
