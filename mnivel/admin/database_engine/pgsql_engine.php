<?php

include_once("engine.php");
include_once("pdo_engine.php");

class PgConnectionFactory extends ConnectionFactory
{
    public function CreateConnection($AConnectionParams)
    {
        return new PgConnection($AConnectionParams);
    }

    public function CreateDataset($AConnection, $ASQL)
    {
        return new PgDataReader($AConnection, $ASQL);
    }

    public function CreateEngCommandImp()
    {
        return new PgEngCommandImp($this);
    }
}

class PgPDOConnectionFactory extends ConnectionFactory
{
    public function CreateConnection($AConnectionParams)
    {
        return new PgPDOConnection($AConnectionParams);
    }

    public function CreateDataset($AConnection, $ASQL)
    {
        return new PgPDODataReader($AConnection, $ASQL);
    }

    public function CreateEngCommandImp()
    {
        return new PgEngCommandImp($this);
    }
}

class PgConnection extends EngConnection
{
    private $connectionHandle;
    private $connectionError;

    public function ConnectionErrorHandler($errno, $errstr, $errfile, $errline)
    {
        $errorResult = split(':', $errstr, 2);
        $this->connectionError = $errorResult[1];
    }
    
    protected function DoConnect()
    {
        set_error_handler(array($this, 'ConnectionErrorHandler'));
        $this->connectionHandle = @pg_connect(
            "host=" . $this->ConnectionParam('server') . ' ' .
            "dbname=" . $this->ConnectionParam('database') . ' ' .
            "port=" . $this->ConnectionParam('port') . ' ' .
            "user=" . $this->ConnectionParam('username') . ' ' .
            "password=" . $this->ConnectionParam('password')
        );
        restore_error_handler();
        if (!$this->connectionHandle)
            return false;
        if ($this->ConnectionParam('client_encoding') != '')
            $this->ExecSQL('SET CLIENT_ENCODING TO \'' . $this->ConnectionParam('client_encoding') . '\'');
        $this->ExecSQL('SET datestyle = ISO');
        return true;
    }

    protected function DoCreateDataReader($sql)
    {
        return new PgDataReader($this, $sql);
    }

    public function IsDriverSupported()
    {
        return function_exists('pg_connect');
    }

    public function GetDriverNotSupportedMessage()
    {
        return 'php_pgsql extension is not supported';
    }

    protected function DoDisconnect()
    {
        @pg_close($this->connectionHandle);
    }

    public function __construct($connectionParams)
    {
        parent::__construct($connectionParams);
    }
    
    public function GetConnectionHandle()
    {
        return $this->connectionHandle;
    }

    protected function DoExecSQL($ASQL)
    {
        return @pg_query($this->GetConnectionHandle(), $ASQL) ? true : false;
    }

    public function ExecScalarSQL($ASQL) # virtual; abstract;
    {
        $queryHandle = @pg_query($this->GetConnectionHandle(), $ASQL);
        $queryResult = @pg_fetch_array($queryHandle, null, PGSQL_NUM);
        return $queryResult[0];
    }

    public function DoLastError()
    {
        if ($this->connectionHandle)
            return pg_last_error($this->connectionHandle);
        else
            return $this->connectionError;
    }
}

class PgDataReader extends EngDataReader
{
    var $queryResult;
    var $lastFetchedRow;

    protected function FetchField()
    {
        echo "not supprted";
    }

    protected function FetchFields()
    {
        for($i = 0; $i < pg_num_fields($this->queryResult); $i++)
            $this->AddField(pg_field_name($this->queryResult, $i));
    }

    protected function DoOpen()
    {
        $this->queryResult = @pg_query($this->GetConnection()->GetConnectionHandle(), $this->GetSQL());
        if ($this->queryResult)
            return true;
        else
            return false;
    }

    public function __construct($connection, $sql)
    {
        parent::__construct($connection, $sql);
        $this->queryResult = null;
    }

    public function Opened()
    {
        return $this->queryResult ? true : false;
    }

    public function Seek($ARowIndex)
    {
        echo "not supported";
    }

    public function Next()
    {
        $this->lastFetchedRow = pg_fetch_array($this->queryResult);
        return $this->lastFetchedRow ? true : false;
    }

    public function GetActualFieldValue(&$fieldName, $value)
    {
        $fieldInfo = $this->GetFieldInfoByFieldName($fieldName);
        if (!isset($fieldInfo))
            return parent::GetActualFieldValue($fieldName, $value);
        else if ($fieldInfo->FieldType == ftBoolean)
                return ($value == 't') or ($value == '1');
            else
                return parent::GetActualFieldValue($fieldName, $value);
    }

    public function GetFieldValueByName($AFieldName)
    {
        if (pg_field_type($this->queryResult, $this->GetFieldIndexByName($AFieldName)) == 'bytea')
            return pg_unescape_bytea($this->lastFetchedRow[$AFieldName]);
        else
            return $this->GetActualFieldValue($AFieldName, $this->lastFetchedRow[$AFieldName]);
    }
}

class PgEngCommandImp extends EngCommandImp
{
    public function GetCastToCharExpresstion($value)
    {
        return sprintf("CAST(%s AS VARCHAR)", $value);
    }

    protected function CreateCaseSensitiveLikeExpression($left, $right)
    {
        return sprintf('%s LIKE %s', $left, $right);
    }

    protected function CreateCaseInsensitiveLikeExpression($left, $right)
    {
        return sprintf('UPPER(%s) LIKE UPPER(%s)', $left, $right);
    }

    public function QuoteIndetifier($identifier)
    {
        return '"'.$identifier.'"';
    }

    public function EscapeString($string)
    {
        return pg_escape_string($string);
    }

    public function GetFieldValueAsSQL($fieldInfo, $value)
    {
        if ($fieldInfo->FieldType == ftBlob)
            return '\'' . pg_escape_bytea(file_get_contents($value)) . '\'';
        else
            return parent::GetFieldValueAsSQL($fieldInfo, $value);
    }

    public function GetLimitClause($limitCount, $upLimit)
    {
        return "LIMIT $limitCount OFFSET $upLimit";
    }

    public function DoExecuteCustomSelectCommand($connection, $command)
    {
        $upLimit = $command->GetUpLmit();
        $limitCount = $command->GetLimitCount();

        if (isset($upLimit) && isset($limitCount))
        {
            $sql = sprintf('SELECT * FROM (%s) a LIMIT %s OFFSET %s',
                $command->GetSQL(),
                $limitCount,
                $upLimit
            );
            $result = $this->GetConnectionFactory()->CreateDataset($connection, $sql);
            $result->Open();
            return $result;
        }
        else
        {
            return parent::DoExecuteSelectCommand($connection, $command);
        }
    }
}

class PgPDOConnection extends PDOConnection
{
    protected function CreatePDOConnection()
    {
        return new PDO(
        sprintf('pgsql:host=%s port=%s dbname=%s',
        $this->ConnectionParam('server'),
        $this->ConnectionParam('port'),
        $this->ConnectionParam('database')),
        $this->ConnectionParam('username'),
        $this->ConnectionParam('password'));
    }

    protected function DoAfterConnect()
    {
        if ($this->ConnectionParam('client_encoding') != '')
            $this->ExecSQL('SET CLIENT_ENCODING TO \'' . $this->ConnectionParam('client_encoding') . '\'');
        $this->ExecSQL('SET datestyle = ISO');
    }

    protected function DoCreateDataReader($sql)
    {
        return new PgPDODataReader($this, $sql);
    }
}

class PgPDODataReader extends PDODataReader
{
    function __construct($connection, $sql)
    {
        parent::__construct($connection, $sql);
    }

    function GetActualFieldValue(&$fieldName, $value)
    {
        $fieldInfo = $this->GetFieldInfoByFieldName($fieldName);
        if (!isset($fieldInfo))
            return parent::GetActualFieldValue($fieldName, $value);
        else if ($fieldInfo->FieldType == ftBoolean)
                return ($value == 't') or ($value == '1');
            else
                return parent::GetActualFieldValue($fieldName, $value);
    }

    function DoTransformFetchedValue($fieldName, &$fetchedValue)
    {
        if ($this->GetColumnNativeType($fieldName) == 'bytea')
        {
            if (($fetchedValue == null) || (!isset($fetchedValue)))
                return null;
            else
                return stream_get_contents($fetchedValue);
        }
        else
            return parent::DoTransformFetchedValue($fieldName, $fetchedValue);
    }
}

?>