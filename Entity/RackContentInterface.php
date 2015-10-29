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
 * Rack content interface
 *
 * @author Radoslaw Kamil Ejsmont <radoslaw@ejsmont.net>
 */
interface RackContentInterface extends ContentInterface
{
    /**
     * Get position
     *
     * @return Bluemesa\StorageBundle\Entity\RackPositionInterface
     */
    public function getPosition();

    /**
     * Set position
     *
     * @param Bluemesa\StorageBundle\Entity\RackPositionInterface $position
     */
    public function setPosition(RackPositionInterface $position = null);
    
    /**
     * Get previous position
     *
     * @return Bluemesa\StorageBundle\Entity\RackPositionInterface
     */
    public function getPreviousPosition();

    /**
     * Set previous position
     *
     * @param Bluemesa\StorageBundle\Entity\RackPositionInterface $prevPosition
     */
    public function setPreviousPosition(RackPositionInterface $prevPosition = null);
    
    /**
     * Get rack
     *
     * @return Bluemesa\StorageBundle\Entity\RackInterface
     */
    public function getRack();

    /**
     * Set rack
     *
     * @param Bluemesa\StorageBundle\Entity\RackInterface $rack
     */
    public function setRack(RackInterface $rack = null);
}
