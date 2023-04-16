<?php
/**
 * 2018-2023 Optyum S.A. All Rights Reserved.
 *
 * NOTICE:  All information contained herein is, and remains
 * the property of Optyum S.A. and its suppliers,
 * if any.  The intellectual and technical concepts contained
 * herein are proprietary to Optyum S.A.
 * and its suppliers and are protected by trade secret or copyright law.
 * Dissemination of this information or reproduction of this material
 * is strictly forbidden unless prior written permission is obtained
 * from Optyum S.A.
 *
 * @author    Optyum S.A.
 * @copyright 2018-2023 Optyum S.A.
 * @license  Optyum S.A. All Rights Reserved
 *  International Registered Trademark & Property of Optyum S.A.
 */

namespace PrestaShop\Module\shopylinkerp\Classes;

use PrestaShop\Module\shopylinkerp\Classes\ShopyManager;

class ShopyUser
{
    private $status;
    private $id;
    private $username;
    private $pass;
    private $name;
    private $lastname;

    public function __construct()
    {
        $user = ShopyManager::getShopyUser();
        $this->setStatus($user['status']);
        $this->setId($user['id']);
        $this->setUsername($user['username']);
        $this->setPass($user['pass']);
        $this->setName($user['name']);
        $this->setLastname($user['lastname']);
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @param mixed $pass
     */
    public function setPass($pass): void
    {
        $this->pass = $pass;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname): void
    {
        $this->lastname = $lastname;
    }

    public function update()
    {
        ShopyManager::setShopyUser([
            'status' => $this->getStatus(),
            'id' => $this->getId(),
            'username' => $this->getUsername(),
            'pass' => $this->getPass(),
            'name' => $this->getName(),
            'lastname' => $this->getLastname(),
        ]);
    }
}
