<?php

/*
 * This file is part of the BluemesaStorageBundle.
 * 
 * Copyright (c) 2016 BlueMesa LabDB Contributors <labdb@bluemesa.eu>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bluemesa\StorageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * StorageUnit class
 *
 * @ORM\MappedSuperclass
 *
 * @author Radoslaw Kamil Ejsmont <radoslaw@ejsmont.net>
 */
abstract class StorageUnit implements StorageUnitInterface
{
    use StorageUnitTrait;
    
    /**
     * Construct StorageUnit
     *
     */
    public function __construct()
    {
        $this->name = 'New storage unit';
        $this->{$this->getContentsProperty()} = new ArrayCollection();
    }
}
