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
 * Rack content interface
 *
 * @author Radoslaw Kamil Ejsmont <radoslaw@ejsmont.net>
 */
interface RackContentInterface extends ContentInterface
{
    /**
     * Get position
     *
     * @return Bluemesa\Bundle\StorageBundle\Entity\RackPositionInterface
     */
    public function getPosition();

    /**
     * Set position
     *
     * @param Bluemesa\Bundle\StorageBundle\Entity\RackPositionInterface $position
     */
    public function setPosition(RackPositionInterface $position = null);
    
    /**
     * Get previous position
     *
     * @return Bluemesa\Bundle\StorageBundle\Entity\RackPositionInterface
     */
    public function getPreviousPosition();

    /**
     * Set previous position
     *
     * @param Bluemesa\Bundle\StorageBundle\Entity\RackPositionInterface $prevPosition
     */
    public function setPreviousPosition(RackPositionInterface $prevPosition = null);
    
    /**
     * Get rack
     *
     * @return Bluemesa\Bundle\StorageBundle\Entity\RackInterface
     */
    public function getRack();

    /**
     * Set rack
     *
     * @param Bluemesa\Bundle\StorageBundle\Entity\RackInterface $rack
     */
    public function setRack(RackInterface $rack = null);
}
