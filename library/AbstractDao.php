<?php
if (file_exists('library/Import.php'))
    include_once 'library/Import.php';
elseif (file_exists('../../library/Import.php'))
    include_once '../../library/Import.php';
else
    include_once '../library/Import.php';

Import::config('Configuracao');

class AbstractDao
{

    protected $sql;

    private $pdo;

    private $stmt;

    private $increment;

    private function conn()
    {
        if ($this->pdo == null) {
            try {
                $this->pdo = new PDO(Configuracao::getDns(), Configuracao::USER_DATA_BASE, Configuracao::PASSWORD_DATA_BASE);
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                return false;
            }
        }

        return true;
    }

    protected function isPersist($table = NULL, $id = NULL)
    {
        $this->execute();
        // try {
        // $this->pdo->commit();
        // } catch (PDOException $e) {
        // $this->pdo->rollBack();
        // echo $e;
        // }
        return $this->lastInsertId($table, $id);
    }

    protected function lastInsertId($table = NULL, $id = NULL)
    {
        if ($this->pdo->lastInsertId())
            return $this->pdo->lastInsertId();
        else {
            $this->sql = "select max(\"" . $id . "\") from " . $table . ";";
            $this->prepare();
            return $this->singleResult()['max'];
        }
    }

    protected function execute()
    {
        return $this->stmt->execute();
    }

    protected function fetchAll()
    {
        $this->execute();
        return $this->stmt->fetchAll();
    }

    protected function singleResult()
    {
        return ($this->fetchAll() != null) ? $this->fetchAll()[0] : null;
    }

    protected function setParam($dado)
    {
        $this->stmt->bindParam(++ $this->increment, $dado);
    }

    protected function prepare()
    {
        // try {
        if ($this->conn())
            $this->prepareStmtSql();
        // } catch (PDOException $e) {
        // print $e->getMessage();
        // }
    }

    private function prepareStmtSql()
    {
        // $this->pdo->beginTransaction();
        $this->stmt = $this->pdo->prepare($this->sql);
        $this->increment = 0;
    }
}
