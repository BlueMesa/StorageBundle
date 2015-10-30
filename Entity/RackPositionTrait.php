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
use Symfony\Component\Validator\Constraints as Assert;

/**
 * RackPositionTrait
 *
 * @author Radoslaw Kamil Ejsmont <radoslaw@ejsmont.net>
 */
trait RackPositionTrait
{
    /**
     * @ORM\Column(type="integer", nullable=false)
     * @Serializer\Expose
     * @Assert\NotBlank(message = "Row must be specified")
     *
     * @var string
     */
    protected $rackRow;

    /**
     * @ORM\Column(type="integer", nullable=false)
     * @Serializer\Expose
     * @Assert\NotBlank(message = "Column must be specified")
     *
     * @var string
     */
    protected $rackColumn;
    
    
    /**
     * Get the name of contents property
     * 
     * @return string
     */
    abstract protected function getContentProperty();
    
    /**
     * Get the name of rack property
     * 
     * @return string
     */
    abstract protected function getRackProperty();
    
    /**
     * @see getRow
     */
    protected function getRackRow()
    {
        return $this->rackRow;
    }

    /**
     * Get row (as string)
     *
     * @return string
     */
    public function getRow()
    {
        return $this->numberToRow($this->getRackRow());
    }

    /**
     * @see setRow
     */
    protected function setRackRow($rackRow)
    {
        $this->rackRow = $this->rowToNumber($rackRow);
    }

    /**
     * Set row
     * 
     * @param string|integer $row
     */
    protected function setRow($row)
    {
        $this->setRackRow($row);
    }

    /**
     * @see getColumn
     */
    protected function getRackColumn()
    {
        return $this->rackColumn;
    }

    /**
     * Alias for getRackColumn
     *
     * @return type
     */
    public function getColumn()
    {
        return $this->getRackColumn();
    }

    /**
     * @see setColumn
     */
    protected function setRackColumn($rackColumn)
    {
        $this->rackColumn = $rackColumn;
    }

    /**
     * Set column
     * 
     * @param integer $column
     */
    protected function setColumn($column)
    {
        $this->setRackColumn($column);
    }

    /**
     * Does this position have provided coordinates
     *
     * @param  string  $row
     * @param  integer $column
     * @return boolean
     */
    public function isAt($row, $column)
    {
        return ((null === $row)||($this->getRackRow() == $this->rowToNumber($row))) &&
               ((null === $column)||($this->getColumn() == $column));
    }

    /**
     * Get rack
     *
     * @return Bluemesa\Bundle\StorageBundle\Entity\RackInterface
     */
    public function getRack()
    {
        return $this->{$this->getRackProperty()};
    }

    /**
     * Set rack
     * 
     * @param Bluemesa\Bundle\StorageBundle\Entity\RackInterface $rack
     */
    protected function setRack(RackInterface $rack)
    {
        $this->{$this->getRackProperty()} = $rack;
    }

    /**
     * Get content
     *
     * @return Bluemesa\Bundle\StorageBundle\Entity\ContentInterface
     */
    public function getContent()
    {
        return $this->{$this->getContentProperty()};
    }

    /**
     * Set content
     *
     * @param Bluemesa\Bundle\StorageBundle\Entity\ContentInterface $contents
     */
    public function setContent(RackContentInterface $contents = null)
    {
        $prevContent = $this->getContent();
        $this->setPreviousContent($prevContent);
        if (null !== $prevContent) {
            $prevContent->setPosition(null);
        }
        $this->{$this->getContentProperty()} = $contents;
        if ((null !== $contents)&&($contents->getPosition() !== $this)) {
            $contents->setPosition($this);
        }
    }
    
    /**
     * It this position empty
     *
     * @return boolean
     */
    public function isEmpty()
    {
        return (null === $this->getContent());
    }

    /**
     * Set previous contents
     *
     * @param Bluemesa\Bundle\StorageBundle\Entity\ContentInterface $prevContent
     */
    public function setPreviousContent(RackContentInterface $previousContent = null)
    {
        if ((null !== $previousContent)&&($previousContent->getPreviousPosition() !== $this)) {
            $previousContent->setPreviousPosition($this);
        }
    }

    /**
     * Convert row letter to a number
     * 
     * @param  string  $row
     * @return integer
     */
    private function rowToNumber($row)
    {
        if (!is_numeric($row) && is_string($row)) {
            $base = ord('z') - ord('a') + 1;
            $characters = array_reverse(str_split(strtolower($row)));
            $row = 0;
            foreach ($characters as $exp => $character) {
                $row += (ord($character) - ord('a') + 1) * pow($base,$exp);
            }
        }

        return $row;
    }

    /**
     * Convert a number to row letter
     * 
     * @param  inetger $row
     * @return string
     */
    protected function numberToRow($row)
    {
        if (is_numeric($row)) {
            $base = ord('z') - ord('a') + 1;
            $rest = $row;
            $characters = array();
            while ($rest > $base) {
                $div = floor($rest / $base);
                $characters[] = chr(ord('a') + $div - 1);
                $rest = $rest % $base;
            }
            $characters[] = chr(ord('a') + $rest - 1);

            return strtoupper(implode(array_reverse($characters)));
        } else {
            return $row;
        }
    }
}
