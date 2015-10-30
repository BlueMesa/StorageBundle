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
 * RackContentTrait
 *
 * @author Radoslaw Kamil Ejsmont <radoslaw@ejsmont.net>
 */
abstract class RackContentTrait
{
    /**
     * Get the name of position property
     * 
     * @return string
     */
    abstract protected function getPositionProperty();
    
    /**
     * Get the name of previous position property
     * 
     * @return string
     */
    abstract protected function getPreviousPositionProperty();
    
    /**
     * Get position
     *
     * @return Bluemesa\Bundle\StorageBundle\Entity\RackPositionInterface
     */
    public function getPosition()
    {
        return $this->{$this->getPositionProperty()};
    }
    
    /**
     * Set position
     *
     * @param Bluemesa\Bundle\StorageBundle\Entity\RackPositionInterface $position
     */
    public function setPosition(RackPositionInterface $position = null)
    {
        $prevPosition = $this->getPosition();
        $this->setPreviousPosition($prevPosition);
        $this->{$this->getPositionProperty()} = $position;
        if ((null !== $prevPosition)&&(null === $position)) {
            $prevPosition->setContent(null);
        }
        if ((null !== $position)&&($position->getContent() !== $this)) {
            $position->setContent($this);
        }
    }

    /**
     * Get previous position
     *
     * @return Bluemesa\Bundle\StorageBundle\Entity\RackPositionInterface
     */
    public function getPreviousPosition()
    {
        return $this->{$this->getPreviousPositionProperty()};
    }

    /**
     * Set previous position
     *
     * @param Bluemesa\Bundle\StorageBundle\Entity\RackPositionInterface $previousPosition
     */
    public function setPreviousPosition(RackPositionInterface $previousPosition = null)
    {
        $this->{$this->getPreviousPositionProperty()} = $previousPosition;
    }
    
    /**
     * Get rack
     *
     * @return Bluemesa\Bundle\StorageBundle\Entity\RackInterface
     */
    public function getRack()
    {
        $position = $this->getPosition();
        
        return (null !== $position) ? $position->getRack() : null;
    }

    /**
     * Set rack
     *
     * @param Bluemesa\Bundle\StorageBundle\Entity\RackInterface $rack
     */
    public function setRack(RackInterface $rack = null)
    {
        $rack->addContent($this);
    }
    
    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        $position = $this->getPosition();
        $rack = $this->getRack();
        $location = (string) $position;
        
        if ($rack instanceof ContentInterface) {
            $rackLocation = $rack->getLocation();
            $location = ($rackLocation == '') ? $location : $rackLocation . ' ' . $location;
        }
        
        return $location;
    }
}
