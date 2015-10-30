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
 * Rack interface
 *
 * @author Radoslaw Kamil Ejsmont <radoslaw@ejsmont.net>
 */
interface RackInterface extends StorageUnitInterface
{
    /**
     * Get position
     *
     * @param  string   $row
     * @param  integer  $column
     * @return Bluemesa\Bundle\StorageBundle\Entity\RackPositionInterface
     * @throws OutOfBoundsException
     */
    public function getPosition($row, $column);

    /**
     * Count rows in rack
     *
     * @return integer
     */
    public function getRows();

    /**
     * Count columns in rack
     *
     * @return integer
     */
    public function getColumns();

    /**
     * Get geometry
     *
     * @return string
     */
    public function getGeometry();

    /**
     * Set geometry
     *
     * @param integer  $rows
     * @param integer  $columns
     */
    public function setGeometry($rows, $columns);
    
    /**
     * Get contents at $row $column
     *
     * @param string   $row
     * @param integer  $column
     * @return Bluemesa\Bundle\StorageBundle\Entity\RackContentInterface
     */
    public function getContent($row, $column);

    /**
     * Add content (to first empty position)
     *
     * @param  Bluemesa\Bundle\StorageBundle\Entity\RackContentInterface  $content
     * @param  string                                              $row
     * @param  integer                                             $column
     * @return boolean
     */
    public function addContent(RackContentInterface $content, $row = null, $column = null);

    /**
     * Remove content
     *
     * @param Bluemesa\Bundle\StorageBundle\Entity\RackContentInterface  $content
     */
    public function removeContent(RackContentInterface $content);

    /**
     * Replace content at given position
     *
     * @param string                                              $row
     * @param integer                                             $column
     * @param Bluemesa\Bundle\StorageBundle\Entity\RackContentInterface  $content
     */
    public function replaceContent($row, $column, RackContentInterface $content = null);

    /**
     * Clear contents
     *
     */
    public function clearContents();

    /**
     * Check if content is in the rack
     *
     * @param  Bluemesa\Bundle\StorageBundle\Entity\RackContentInterface  $content
     * @return boolean
     */
    public function hasContent(RackContentInterface $content);
}
