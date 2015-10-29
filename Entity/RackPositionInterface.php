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
 * Rack position interface
 *
 * @author Radoslaw Kamil Ejsmont <radoslaw@ejsmont.net>
 */
interface RackPositionInterface
{
    /**
     * Get row (as string)
     *
     * @return string
     */
    public function getRow();

    /**
     * Alias for getRackColumn
     *
     * @return type
     */
    public function getColumn();

    /**
     * Does this position have provided coordinates
     *
     * @param  string  $row
     * @param  integer $column
     * @return boolean
     */
    public function isAt($row, $column);

    /**
     * Get rack
     *
     * @return Bluemesa\StorageBundle\Entity\RackInterface
     */
    public function getRack();

    /**
     * Get content
     *
     * @return Bluemesa\StorageBundle\Entity\ContentInterface
     */
    public function getContent();
    
    /**
     * Set content
     *
     * @param Bluemesa\StorageBundle\Entity\ContentInterface $contents
     */
    public function setContent(RackContentInterface $contents = null);

    /**
     * It this position empty
     *
     * @return boolean
     */
    public function isEmpty();

    /**
     * Set previous contents
     *
     * @param Bluemesa\StorageBundle\Entity\ContentInterface $prevContent
     */
    public function setPreviousContent(RackContentInterface $previousContent = null);
}
