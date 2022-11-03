<?php

class Database
{
    private string $server = 'localhost';
    private string $user = 'root';
    private string $password = 'Root.123';
    private string $database = 'lr20190024';

    private mysqli $client;

    public function connect() : void
    {
        $this->client = new mysqli($this->server, $this->user, $this->password, $this->database);

        if ($this->client->connect_errno) {
            printf("Konekcija neuspešna: %s\n", $this->client->connect_error);
            exit();
        }

        $this->client->set_charset("utf8");
    }

    public function prepare(string $sql) : mysqli_stmt
    {
        return $this->client->prepare($sql);
    }

    public function disconnect() : void
    {
        $this->client->close();
    }
}
