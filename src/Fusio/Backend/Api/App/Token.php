<?php
/*
 * Fusio
 * A web-application to create dynamically RESTful APIs
 *
 * Copyright (C) 2015 Christoph Kappestein <k42b3.x@gmail.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

namespace Fusio\Backend\Api\App;

use Fusio\Authorization\ProtectionTrait;
use PSX\Controller\ApiAbstract;

/**
 * Token
 *
 * @author  Christoph Kappestein <k42b3.x@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0
 * @link    http://fusio-project.org
 */
class Token extends ApiAbstract
{
    use ProtectionTrait;

    /**
     * @Inject
     * @var PSX\Sql\TableManager
     */
    protected $tableManager;

    public function doRemove()
    {
        $appId   = $this->getUriFragment('app_id');
        $tokenId = $this->getUriFragment('token_id');

        $app = $this->tableManager->getTable('Fusio\Backend\Table\App')->get($appId);

        $this->tableManager->getTable('Fusio\Backend\Table\App\Token')->removeTokenFromApp($appId, $tokenId);

        $this->setBody(array(
            'success' => true,
            'message' => 'Removed token successful',
        ));
    }
}