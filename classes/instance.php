<?php
class Instance
{
    private $status;
    private $id_instance;
    private $prefix;
    private $url_front;
    private $url_admin;
    private $user_admin;
    private $pass_admin;
    private $connection_mode;
    private $server;
    private $name_bd;
    private $user_bd;
    private $pass_bd;
    private $ftp_user;
    private $ftp_pass;
    private $ftp_server;
    private $ftp_port;
    private $ftp_ssl;
    private $ftp_root;
    private $connection_key;
    private $date_add;

    public function __construct()
    {
        $config = json_decode(Configuration::get('SHOPYLINKER_UDATA'), true);

        $instance = $config['instance'];

        $this->setStatus($instance['status']);
        $this->setIdInstance($instance['id_instance']);
        $this->setPrefix($instance['prefix']);
        $this->setUrlFront($instance['url_front']);
        $this->setUrlAdmin($instance['url_admin']);
        $this->setUserAdmin($instance['user_admin']);
        $this->setPassAdmin($instance['pass_admin']);
        $this->setConnectionMode($instance['connection_mode']);
        $this->setServer($instance['server']);
        $this->setNameBd($instance['name_bd']);
        $this->setUserBd($instance['user_bd']);
        $this->setPassBd($instance['pass_bd']);
        $this->setFtpUser($instance['ftp_user']);
        $this->setFtpPass($instance['ftp_pass']);
        $this->setFtpServer($instance['ftp_server']);
        $this->setFtpPort($instance['ftp_port']);
        $this->setFtpSsl($instance['ftp_ssl']);
        $this->setFtpRoot($instance['ftp_root']);
        $this->setConnectionKey($instance['connection_key']);
        $this->setDateAdd($instance['date_add']);
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
    public function getIdInstance()
    {
        return $this->id_instance;
    }

    /**
     * @param mixed $id_instance
     */
    public function setIdInstance($id_instance): void
    {
        $this->id_instance = $id_instance;
    }

    /**
     * @return mixed
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @param mixed $prefix
     */
    public function setPrefix($prefix): void
    {
        $this->prefix = $prefix;
    }

    /**
     * @return mixed
     */
    public function getUrlFront()
    {
        return $this->url_front;
    }

    /**
     * @param mixed $url_front
     */
    public function setUrlFront($url_front): void
    {
        $this->url_front = $url_front;
    }

    /**
     * @return mixed
     */
    public function getUrlAdmin()
    {
        return $this->url_admin;
    }

    /**
     * @param mixed $url_admin
     */
    public function setUrlAdmin($url_admin): void
    {
        $this->url_admin = $url_admin;
    }

    /**
     * @return mixed
     */
    public function getUserAdmin()
    {
        return $this->user_admin;
    }

    /**
     * @param mixed $user_admin
     */
    public function setUserAdmin($user_admin): void
    {
        $this->user_admin = $user_admin;
    }

    /**
     * @return mixed
     */
    public function getPassAdmin()
    {
        return $this->pass_admin;
    }

    /**
     * @param mixed $pass_admin
     */
    public function setPassAdmin($pass_admin): void
    {
        $this->pass_admin = $pass_admin;
    }

    /**
     * @return mixed
     */
    public function getConnectionMode()
    {
        return $this->connection_mode;
    }

    /**
     * @param mixed $connection_mode
     */
    public function setConnectionMode($connection_mode): void
    {
        $this->connection_mode = $connection_mode;
    }

    /**
     * @return mixed
     */
    public function getServer()
    {
        return $this->server;
    }

    /**
     * @param mixed $server
     */
    public function setServer($server): void
    {
        $this->server = $server;
    }

    /**
     * @return mixed
     */
    public function getNameBd()
    {
        return $this->name_bd;
    }

    /**
     * @param mixed $name_bd
     */
    public function setNameBd($name_bd): void
    {
        $this->name_bd = $name_bd;
    }

    /**
     * @return mixed
     */
    public function getUserBd()
    {
        return $this->user_bd;
    }

    /**
     * @param mixed $user_bd
     */
    public function setUserBd($user_bd): void
    {
        $this->user_bd = $user_bd;
    }

    /**
     * @return mixed
     */
    public function getPassBd()
    {
        return $this->pass_bd;
    }

    /**
     * @param mixed $pass_bd
     */
    public function setPassBd($pass_bd): void
    {
        $this->pass_bd = $pass_bd;
    }

    /**
     * @return mixed
     */
    public function getFtpUser()
    {
        return $this->ftp_user;
    }

    /**
     * @param mixed $ftp_user
     */
    public function setFtpUser($ftp_user): void
    {
        $this->ftp_user = $ftp_user;
    }

    /**
     * @return mixed
     */
    public function getFtpPass()
    {
        return $this->ftp_pass;
    }

    /**
     * @param mixed $ftp_pass
     */
    public function setFtpPass($ftp_pass): void
    {
        $this->ftp_pass = $ftp_pass;
    }

    /**
     * @return mixed
     */
    public function getFtpServer()
    {
        return $this->ftp_server;
    }

    /**
     * @param mixed $ftp_server
     */
    public function setFtpServer($ftp_server): void
    {
        $this->ftp_server = $ftp_server;
    }

    /**
     * @return mixed
     */
    public function getFtpPort()
    {
        return $this->ftp_port;
    }

    /**
     * @param mixed $ftp_port
     */
    public function setFtpPort($ftp_port): void
    {
        $this->ftp_port = $ftp_port;
    }

    /**
     * @return mixed
     */
    public function getFtpSsl()
    {
        return $this->ftp_ssl;
    }

    /**
     * @param mixed $ftp_ssl
     */
    public function setFtpSsl($ftp_ssl): void
    {
        $this->ftp_ssl = $ftp_ssl;
    }

    /**
     * @return mixed
     */
    public function getFtpRoot()
    {
        return $this->ftp_root;
    }

    /**
     * @param mixed $ftp_root
     */
    public function setFtpRoot($ftp_root): void
    {
        $this->ftp_root = $ftp_root;
    }



    /**
     * @return mixed
     */
    public function getConnectionKey()
    {
        return $this->connection_key;
    }

    /**
     * @param mixed $connection_key
     */
    public function setConnectionKey($connection_key): void
    {
        $this->connection_key = $connection_key;
    }

    /**
     * @return mixed
     */
    public function getDateAdd()
    {
        return $this->date_add;
    }

    /**
     * @param mixed $date_add
     */
    public function setDateAdd($date_add): void
    {
        $this->date_add = $date_add;
    }

    public function update()
    {
        $config = json_decode(Configuration::get('SHOPYLINKER_UDATA'), true);

        $config['instance'] = [
            'status' => $this->getStatus(),
            'id_instance' => $this->getIdInstance(),
            'prefix' => $this->getPrefix(),
            'url_front' => $this->getUrlFront(),
            'url_admin' => $this->getUrlAdmin(),
            'user_admin' => $this->getUserAdmin(),
            'pass_admin' => $this->getPassAdmin(),
            'connection_mode' => $this->getConnectionMode(),
            'server' => $this->getServer(),
            'name_bd' => $this->getNameBd(),
            'user_bd' => $this->getUserBd(),
            'pass_bd' => $this->getPassBd(),
            'ftp_user' => $this->getFtpUser(),
            'ftp_pass' => $this->getFtpPass(),
            'ftp_server' => $this->getFtpServer(),
            'ftp_port' => $this->getFtpPort(),
            'ftp_ssl' => $this->getFtpSsl(),
            'ftp_root' => $this->getFtpRoot(),
            'connection_key' => $this->getConnectionKey(),
            'date_add' => $this->getDateAdd(),
        ];

        Configuration::updateValue('SHOPYLINKER_UDATA', json_encode($config));

    }
}
