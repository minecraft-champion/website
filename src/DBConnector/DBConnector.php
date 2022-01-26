<?php
namespace App\DBConnector;

use PDO;

class DBConnector {

    private string $connector;
    private PDO $pdo;

    /**
     * DBConnector constructor.
     * @param string $type Database's type (mysql, oracle, etc.) /!\ Don't work with sqlite et any others database working with a file
     * @param string $host Host of the database (localhost, 92.125.127.8, etc.)
     * @param string $port Port of the database (6123, 4254, 25565, etc.)
     * @param string $dbName Name of the database (article, news, etc.)
     */
    public function __construct(string $type, string $host, string $port, string $dbName)
    {
        $this->connector = $type . ':host=' . $host . ';port=' . $port . ';dbname=' . $dbName;
    }

    /**
     * Connection to the database
     * @param string $username Username (root, anhgelus, etc)
     * @param string $passwd Password
     */
    public function connect(string $username, string $passwd): void
    {
        $this->pdo = new PDO($this->connector, $username, $passwd);

        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Get information in the database
     * @param string $selector Selector (*, title, etc)
     * @param string $table Table
     * @param string|null $other Other args
     * @return array Result of the research
     */
    public function getInformation(string $selector, string $table, string $other = null): array
    {
        if ($other != null) {
            $arg = "SELECT " . $selector . " FROM " . $table . " " . $other;
        } else {
            $arg = "SELECT " . $selector . " FROM " . $table;
        }
        return $this->pdo->query($arg)->fetchAll();
    }

    /**
     * Insert data into the database
     * @param string $table Table
     * @param array $data Data to put, ex: ['title' => 'A Title', 'content' => 'Just an interesting content'], for more information, see the doc
     * @param array $sqlPart Column to put information ['title', 'content'] It must be the key index of the $data, for more information, see the doc
     */
    public function putInformation(array $data, array $sqlPart, string $table): void
    {
        $sql = "INSERT INTO " . $table . ' (';
        for ($i = 0; $i < count($sqlPart); $i++) {
            if ($i == count($sqlPart) - 1) {
                $sql = $sql . $sqlPart[$i];
            } else {
                $sql = $sql . $sqlPart[$i] . ', ';
            }
            print $i;
        }
        $sql = $sql . ') VALUES (';
        for ($i = 0; $i < count($sqlPart); $i++) {
            if ($i == count($sqlPart) - 1) {
                $sql = $sql . ':' . $sqlPart[$i];
            } else {
                $sql = $sql . ':' . $sqlPart[$i] . ', ';
            }
        }
        $sql = $sql . ')';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
    }

    /**
     * Delete information
     * @param int $type Type of delete, see the doc
     * @param string $table Table
     * @param null|string $signe Signe to use ("=", "<", ">", "<=", ">=") [only for type 1]
     * @param null|string $where Where we must delete [only for type 1]
     * @param null|string $query Value to delete [only for type 1]
     * @example delInformation(1, "table", "=", "id", "1") -> SQL = "DELETE FROM table WHERE id = 1"
     */
    public function delInformation(int $type, string $table, ?string $signe = "=", ?string $where = "id", ?string $query = null): void
    {
        if ($type === 0) {
            $sql = "DELETE FROM " . $table;
        } else if ($type === 1) {
            if ($query != null) {
                $sql = "DELETE FROM " . $table . "WHERE '" . $where . " " . $signe . " " . $query;
            } else {
                exit("Query is null");
            }
        } else {
            exit("Error type");
        }
        $this->pdo->query($sql);
    }
}