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

use Doctrine\Common\Collections\ArrayCollection;


/**
 * ContainerTrait
 *
 * @author Radoslaw Kamil Ejsmont <radoslaw@ejsmont.net>
 */
trait RackTrait
{
    /**
     * @var integer
     */
    private $rows;

    /**
     * @var integer
     */
    private $columns;
    
    
    /**
     * Get the name of positions property
     * 
     * @return string
     */
    abstract protected function getPositionsProperty();
    
    /**
     * Get the name of position class
     * 
     * @return string
     */
    abstract protected function getPositionClass();

    /**
     * Get position
     *
     * @param  string                                         $row
     * @param  integer                                        $column
     * @return Bluemesa\StorageBundle\Entity\RackPositionInterface
     * @throws OutOfBoundsException
     */
    public function getPosition($row, $column)
    {
        foreach ($this->getPositions() as $position) {
            if ($position->isAt($row, $column)) {
                
                return $position;
            }
        }
        throw new \OutOfBoundsException();
    }

    /**
     * Count rows in rack
     *
     * @return integer
     */
    public function getRows()
    {
        $this->updateGeometry();

        return $this->rows;
    }

    /**
     * Count columns in rack
     *
     * @return integer
     */
    public function getColumns()
    {
        $this->updateGeometry();

        return $this->columns;
    }

    /**
     * Get geometry
     *
     * @return string
     */
    public function getGeometry()
    {
        $this->updateGeometry();

        return $this->rows . " ✕ " . $this->columns;
    }

    /**
     * Set geometry
     *
     * @param integer $rows
     * @param integer $columns
     */
    public function setGeometry($rows, $columns)
    {
        if (($rows > 0) && ($columns > 0)) {
            $this->updateGeometry();
            if (($this->rows != $rows) || ($this->columns != $columns)) {
                $positionClass = $this->getPositionClass();
                $this->getPositions()->clear();
                for ($row = 1; $row <= $rows; $row++) {
                    for ($column = 1; $column <= $columns; $column++) {
                        $this->positions[] = new $positionClass($this, $row, $column);
                    }
                }
                $this->rows = $rows;
                $this->columns = $columns;
            }
        }
    }
    
    /**
     * Get contents at $row $column
     *
     * @param  string                                        $row
     * @param  integer                                       $column
     * @return Bluemesa\StorageBundle\Entity\RackContentInterface
     */
    public function getContent($row, $column)
    {
        return $this->getPosition($row, $column)->getContent();
    }

    /**
     * Get contents
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getContents()
    {
        $contents = new ArrayCollection();
        foreach ($this->getPositions() as $position) {
            if (($content = $position->getContent()) !== null) {
                $contents[] = $content;
            }
        }

        return $contents;
    }

    /**
     * Add content (to first empty position)
     *
     * @param  Bluemesa\StorageBundle\Entity\RackContentInterface $content
     * @param  string                                        $row
     * @param  integer                                       $column
     * @return boolean
     */
    public function addContent(RackContentInterface $content, $row = null, $column = null)
    {
        $position = $this->getFirstEmptyPosition($row, $column);
        if ($position != null) {
            $position->setContent($content);

            return true;
        } else {
            
            return false;
        }
    }

    /**
     * Remove content
     *
     * @param Bluemesa\StorageBundle\Entity\RackContentInterface $content
     */
    public function removeContent(RackContentInterface $content)
    {
        foreach ($this->getPositions() as $position ) {
            if ($position->getContent() === $content) {
                $position->setContent(null);
            }
        }
    }

    /**
     * Replace content at given position
     *
     * @param string                                              $row
     * @param integer                                             $column
     * @param Bluemesa\StorageBundle\Entity\RackContentInterface  $content
     */
    public function replaceContent($row, $column, RackContentInterface $content = null)
    {
        $this->setPosition($row, $column, $content);
    }

    /**
     * Clear contents
     *
     */
    public function clearContents()
    {
        foreach ($this->getPositions() as $position ) {
            $position->setContent(null);
        }
    }

    /**
     * Check if content is in the rack
     *
     * @param  Bluemesa\StorageBundle\Entity\RackContentInterface $content
     * @return boolean
     */
    public function hasContent(RackContentInterface $content)
    {
        return $this->getContents()->contains($content);
    }

    /**
     * Get positions
     *
     * @return Doctrine\Common\Collections\Collection
     */
    protected function getPositions()
    {
        return $this->{$this->getPositionsProperty()};
    }


    /**
     * Get first empty position
     *
     * @param  string                               $row
     * @param  integer                              $column
     * @return Bluemesa\StorageBundle\Entity\RackPosition
     * @throws OutOfBoundsException
     */
    protected function getFirstEmptyPosition($row = null, $column = null)
    {
        foreach ($this->getPositions() as $position) {
            if ($position->isAt($row, $column) && $position->isEmpty()) {
                
                return $position;
            }
        }

        return null;
    }

    /**
     * Set position
     *
     * @param string                                         $row
     * @param integer                                        $column
     * @param Bluemesa\StorageBundle\Entity\ContentInterface $content
     */
    protected function setPosition($row, $column, RackContentInterface $content = null)
    {
        $this->getPosition($row, $column)->setContent($content);
    }

    /**
     * Update counters for rows and columns
     *
     */
    protected function updateGeometry()
    {
        if ((null === $this->rows)||(null === $this->columns)) {
            $rows = array();
            $columns = array();
            foreach ($this->getPositions() as $position) {
                $rows[$position->getRow()] = true;
                $columns[$position->getColumn()] = true;
            }
            $this->rows = count($rows);
            $this->columns = count($columns);
        }
    }
}
