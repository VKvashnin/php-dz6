<?php

namespace Academy;

use PDO;

class Connect
{
    /** @var string */
    public $host = 'db';

    /** @var string */
    public $user = 'root';

    /** @var string */
    public $password = '1234';

    /** @var string */
    public $db = 'test_db';

    /** @var string */
    public $charset = 'utf8';

    /** @var PDO */
    public $pdo = null;

    public function __construct()
    {
        $dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        $this->pdo = new PDO($dsn, $this->user, $this->password, $opt);
    }
}