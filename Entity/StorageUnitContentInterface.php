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


/**
 * Storage unit content interface
 *
 * @author Radoslaw Kamil Ejsmont <radoslaw@ejsmont.net>
 */
interface StorageUnitContentInterface extends ContentInterface
{
    /**
     * Get storage unit
     *
     * @return Bluemesa\StorageBundle\Entity\StorageUnitInterface
     */
    public function getStorageUnit();
    
    /**
     * Set storage unit
     *
     * @param Bluemesa\StorageBundle\Entity\StorageUnitInterface $unit
     */
    public function setStorageUnit(StorageUnitInterface $unit = null);
}
