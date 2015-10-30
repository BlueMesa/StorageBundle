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


/**
 * StorageUnitTrait
 *
 * @author Radoslaw Kamil Ejsmont <radoslaw@ejsmont.net>
 */
trait StorageUnitTrait
{
    /**
     * Get the name of contents property
     * 
     * @return string
     */
    abstract protected function getContentsProperty();
    
    /**
     * Get contents
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getContents()
    {
        return $this->{$this->getContentsProperty()};
    }
}
