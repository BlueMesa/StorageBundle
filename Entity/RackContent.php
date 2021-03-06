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
use Bluemesa\Bundle\CoreBundle\Entity\Entity;


/**
 * Content class
 *
 * @ORM\MappedSuperclass
 *
 * @author Radoslaw Kamil Ejsmont <radoslaw@ejsmont.net>
 */
abstract class RackContent extends Entity implements RackContentInterface
{
    use RackContentTrait;
}
