<?php

require_once 'engine.php';
require_once 'database_engine_utils.php';

class FieldType
{
    const Number     = 1;
    const String     = 2;
    const Blob       = 3;
    const DateTime   = 4;
    const Date       = 5;
    const Time       = 6;
    const Boolean    = 7;
}

class JoinKind
{
    const LeftOuter =  1;
    const Inner     =  2;
}

class Aggregate
{
    const Average   = 1;
    const Sum       = 2;
    const Max       = 3;
    const Min       = 4;
    const Count     = 5;

    public static function AsString($aggregate)
    {
        return Aggregate::AsSQL($aggregate);
    }

    public static function AsSQL($aggregate)
    {
        switch ($aggregate)
        {
            case Aggregate::Average:
                return 'AVG';
            case Aggregate::Sum:
                return 'SUM';
            case Aggregate::Max:
                return 'MAX';
            case Aggregate::Min:
                return 'MIN';
            case Aggregate::Count:
                return 'COUNT';
        }
    }

}

#region Deprecated

define('ftNumber', 1);
define('ftString', 2);
define('ftBlob', 3);
define('ftDateTime', 4);
define('ftDate', 5);
define('ftTime', 6);
define('ftBoolean', 7);

define('jkLeftOuter', 1);

#endregion

class JoinInfo
{
    public $JoinKind;
    public $Table;
    public $Field;
    public $LinkField;
    public $TableAlias;
    
    public function __construct($joinKind, $table, FieldInfo $field, $linkField, $tableAlias)
    {
        $this->JoinKind = $joinKind;
        $this->Table = $table;
        $this->Field = $field;
        $this->LinkField = $linkField;
        $this->TableAlias = $tableAlias;
    }
}

class FilterConditionGenerator
{
    private $resultCondition;
    private $field;
    private $engCommandImp;

    public function __construct($engCommandImp)
    {
        $this->engCommandImp = $engCommandImp;
    }

    public function CreateCondition($filter, $field)
    {
        $result = '';
        $oldResultCondition = $this->resultCondition;

        $oldField = $this->field;
        $this->field = $field;

        $filter->Accept($this);

        $this->field = $oldField;
        $result = $this->resultCondition;
        $this->resultCondition = $oldResultCondition;

        return $result;
    }

    public function VisitFieldFilter($filter)
    {
        if ($filter->GetIgnoreFieldDataType())
        {
            if ($filter->GetFilterType() == 'LIKE')
            {
                $this->resultCondition = $this->engCommandImp->GetCaseSensitiveLikeExpression(
                    $this->field,
                    $filter->GetValue()
                    );
            }
            elseif ($filter->GetFilterType() == 'ILIKE')
            {
                $this->resultCondition = $this->engCommandImp->GetCaseInsensitiveLikeExpression(
                    $this->field,
                    $filter->GetValue()
                    );
            }
            else
                $this->resultCondition =
                    $this->engCommandImp->GetCastedToCharFieldExpression($this->field) . ' ' .
                    $filter->GetFilterType() . ' ' .
                    $this->engCommandImp->GetValueAsSQLString($filter->GetValue());
        }
        else
        {
            $value = $filter->GetValue();
            if ($value === '' && $this->field->FieldType == ftNumber)
            {
                if ($filter->GetFilterType() == '=')
                    $this->resultCondition = $this->engCommandImp->GetIsNullCoditition($this->engCommandImp->GetFieldFullName($this->field));
                elseif($filter->GetFilterType() == '<>')
                    $this->resultCondition = sprintf('NOT (%s)', $this->engCommandImp->GetIsNullCoditition($this->engCommandImp->GetFieldFullName($this->field)));
            }
            elseif (isset($value))
            {
                if ($filter->GetFilterType() == 'LIKE')
                {
                    $this->resultCondition = $this->engCommandImp->GetCaseSensitiveLikeExpression(
                        $this->field,
                        $filter->GetValue()
                        );
                }
                elseif ($filter->GetFilterType() == 'ILIKE')
                {
                    $this->resultCondition = $this->engCommandImp->GetCaseInsensitiveLikeExpression(
                        $this->field,
                        $filter->GetValue()
                        );
                }
                else
                {
                    $this->resultCondition =
                        $this->engCommandImp->GetFieldFullName($this->field) . ' ' .
                        $filter->GetFilterType() . ' ' .
                        $this->engCommandImp->GetFieldValueAsSQL($this->field, $filter->GetValue());
                }
            }
            else
            {
                if ($filter->GetFilterType() == '=')
                    $this->resultCondition = $this->engCommandImp->GetIsNullCoditition($this->engCommandImp->GetFieldFullName($this->field));
                elseif($filter->GetFilterType() == '<>')
                    $this->resultCondition = sprintf('NOT (%s)', $this->engCommandImp->GetIsNullCoditition($this->engCommandImp->GetFieldFullName($this->field)));
            }
        }

    }

    public function VisitBetweenFieldFilter($filter)
    {
        $this->resultCondition =
            sprintf('(%s BETWEEN %s AND %s)',
                $this->engCommandImp->GetFieldFullName($this->field),
                $this->engCommandImp->GetFieldValueAsSQL($this->field, $filter->GetStartValue()),
                $this->engCommandImp->GetFieldValueAsSQL($this->field, $filter->GetEndValue()));
    }

    public function VisitNotPredicateFilter($filter)
    {
        $this->resultCondition = sprintf('NOT (%s)',
            $this->CreateCondition($filter->InnerFilter, $this->field));
    }

    public function VisitCompositeFilter($filter)
    {
        $this->resultCondition = '';
        foreach($filter->GetInnerFilters() as $filterInfo)
            AddStr($this->resultCondition,
                '(' . $this->CreateCondition($filterInfo['filter'], $filterInfo['field']) . ')',
                ' ' . $filter->GetFilterLinkType() . ' ');
    }

    public function VisitIsNullFieldFilter($filter)
    {
        $this->resultCondition = $this->engCommandImp->GetIsNullCoditition($this->engCommandImp->GetFieldFullName($this->field));
    }
}

class FieldFilter
{
    private $value;
    private $filterType;
    private $ignoreFieldDataType;

    public static function Contains($value)
    {
        return new FieldFilter('%' . $value . '%', 'ILIKE', true);
    }

    public static function Equals($value) 
    {
        return new FieldFilter($value, '=', $value);
    }

    public function  __construct($value, $filterType, $ignoreFieldDataType = false)
    {
        $this->value = $value;
        $this->filterType = $filterType;
        $this->ignoreFieldDataType = $ignoreFieldDataType;
    }

    public function GetFilterType()
    {
        return $this->filterType;
    }

    public function GetValue()
    {
        return $this->value;
    }

    public function GetIgnoreFieldDataType()
    {
        return $this->ignoreFieldDataType;
    }

    public function Accept($filterVisitor)
    {
        $filterVisitor->VisitFieldFilter($this);
    }
}

class BetweenFieldFilter
{
    private $startValue;
    private $endValue;

    public function  __construct($startValue, $endValue)
    {
        $this->startValue = $startValue;
        $this->endValue = $endValue;
    }

    public function GetStartValue()
    {
        return $this->startValue;
    }

    public function GetEndValue()
    {
        return $this->endValue;
    }

    public function Accept($filterVisitor)
    {
        $filterVisitor->VisitBetweenFieldFilter($this);
    }
}

class NotPredicateFilter
{
    public $InnerFilter;

    public function __construct($innerFilter)
    {
        $this->InnerFilter = $innerFilter;
    }

    public function Accept($filterVisitor)
    {
        $filterVisitor->VisitNotPredicateFilter($this);
    }
}

class CompositeFilter
{
    private $filterLinkType;
    private $innerFilters;

    public function __construct($filterLinkType)
    {
        $this->filterLinkType = $filterLinkType;
        $this->innerFilters = array();
    }

    public function GetFilterLinkType()
    {
        return $this->filterLinkType;
    }

    public function GetInnerFilters()
    {
        return $this->innerFilters;
    }

    public function AddFilter($field, $filter)
    {
        $this->innerFilters[] = array(
            'field' => $field,
            'filter' => $filter);
    }

    public function Accept($filterVisitor)
    {
        $filterVisitor->VisitCompositeFilter($this);
    }
}

class IsNullFieldFilter
{
    public function  __construct()
    { }

    public function Accept($filterVisitor)
    {
        $filterVisitor->VisitIsNullFieldFilter($this);
    }
}

class FieldInfo
{
    public $TableName;
    public $Name;
    public $FieldType;
    public $Alias;
    
    /**
     * @param FieldType $fieldType See FieldType enum
     */
    public function __construct($tableName, $fieldName, $fieldType, $alias)
    {
        $this->TableName = $tableName;
        $this->Name = $fieldName;
        $this->FieldType = $fieldType;
        $this->Alias = $alias;
    }
}

class EngCommandImp
{
    private $filterConditionGenerator;
    private $connectionFactory;
    private $version;

    public function __construct($connectionFactory)
    {
        $this->filterConditionGenerator = new FilterConditionGenerator($this);
        $this->connectionFactory = $connectionFactory;
        $this->version = new SMVersion(0, 0);
    }

    public function GetServerVersion()
    {
        return $this->version;
    }

    public function SetServerVersion(SMVersion $version)
    {
        $this->version = $version;
    }

    protected function CreateCaseSensitiveLikeExpression($left, $right)
    {
        return sprintf('%s LIKE %s', $left, $right);
    }

    protected function CreateCaseInsensitiveLikeExpression($left, $right)
    {
        return sprintf('UPPER(%s) LIKE UPPER(%s)', $left, $right);
    }

    public function GetCaseSensitiveLikeExpression(FieldInfo $field, $filterValue)
    {
        return $this->CreateCaseSensitiveLikeExpression(
            $this->GetCastedToCharFieldExpression($field),
            $this->GetValueAsSQLString($filterValue)
            );
    }

    public function GetCaseInsensitiveLikeExpression(FieldInfo $field, $filterValue)
    {
        return $this->CreateCaseInsensitiveLikeExpression(
            $this->GetCastedToCharFieldExpression($field),
            $this->GetValueAsSQLString($filterValue)
            );
    }

    protected function GetConnectionFactory()
    { return $this->connectionFactory; }

    public function GetFilterConditionGenerator()
    {
        return $this->filterConditionGenerator;
    }

    protected function GetDateTimeFieldAsSQLForSelect($fieldInfo)
    {
        return $this->GetFieldFullName($fieldInfo);
    }

    protected function GetDateFieldAsSQLForSelect($fieldInfo)
    {
        return $this->GetFieldFullName($fieldInfo);
    }

    protected function GetTimeFieldAsSQLForSelect($fieldInfo)
    {
        return $this->GetFieldFullName($fieldInfo);
    }

    public function GetFieldAsSQLInSelectFieldList($fieldInfo)
    {
        if ($fieldInfo->FieldType == ftDateTime)
            $result = $this->GetDateTimeFieldAsSQLForSelect($fieldInfo);
        elseif ($fieldInfo->FieldType == ftDate)
            $result = $this->GetDateFieldAsSQLForSelect($fieldInfo);
        elseif ($fieldInfo->FieldType == ftTime)
            $result = $this->GetTimeFieldAsSQLForSelect($fieldInfo);
        else
            $result = $this->GetFieldFullName($fieldInfo);

        if (isset($fieldInfo->Alias) && $fieldInfo->Alias != '')
            $result = $this->GetAliasedAsFieldExpression($result, $this->QuoteIndetifier($fieldInfo->Alias));
        else
            $result = $this->GetAliasedAsFieldExpression($result, $this->QuoteIndetifier($fieldInfo->Name));
        return $result;
    }

    public function GetAliasedAsFieldExpression($expression, $alias)
    {
        return StringUtils::Format('%s AS %s', $expression, $alias);
    }

    public function GetCastToCharExpresstion($value)
    {
        return sprintf("CAST(%s AS CHAR)", $value);
    }

    public function GetCastedToCharFieldExpression($fieldInfo)
    {
        return $this->GetCastToCharExpresstion($this->GetFieldFullName($fieldInfo));
    }

    public function GetFieldFullName($fieldInfo)
    {
        if (isset($fieldInfo->TableName) && $fieldInfo->TableName != '')
            return $this->QuoteTableIndetifier($fieldInfo->TableName) . '.' . $this->QuoteIndetifier($fieldInfo->Name);
        else
            return $this->QuoteIndetifier($fieldInfo->Name);
    }

    protected function GetDateTimeFieldValueAsSQL($fieldInfo, $value)
    {
        return '\'' . $value->ToString('Y-m-d H:i:s') . '\'';
    }

    protected function GetDateFieldValueAsSQL($fieldInfo, $value)
    {
        return '\'' . $value->ToString('Y-m-d') . '\'';
    }

    protected function GetTimeFieldValueAsSQL($fieldInfo, $value)
    {
        return '\'' . $value->ToString('H:i:s') . '\'';
    }

    public function GetFieldValueAsSQL($fieldInfo, $value)
    {
        if ($fieldInfo->FieldType == ftNumber)
        {
            $result = str_replace(',', '.', $value);
            if (!is_numeric($result))
                RaiseError('Field "'.$fieldInfo->Name.'" must be a number.');
            return $this->EscapeString($result);
        }
        elseif ($fieldInfo->FieldType == ftDateTime)
        {
            if (!is_string($value) && get_class($value) == 'SMDateTime')
                return $this->GetDateTimeFieldValueAsSQL($fieldInfo, $value);
            else
                return $this->GetDateTimeFieldValueAsSQL($fieldInfo, SMDateTime::Parse($value, ''));
        }
        elseif ($fieldInfo->FieldType == ftDate)
        {
            if (!is_string($value) && (get_class($value) == 'SMDateTime'))
                return $this->GetDateFieldValueAsSQL($fieldInfo, $value);
            else
                return $this->GetDateFieldValueAsSQL($fieldInfo, SMDateTime::Parse($value, ''));
        }
        elseif ($fieldInfo->FieldType == ftTime)
        {
            if (!is_string($value) && get_class($value) == 'SMDateTime')
                return $this->GetTimeFieldValueAsSQL($fieldInfo, $value);
            else
                return $this->GetTimeFieldValueAsSQL($fieldInfo, SMDateTime::Parse($value, ''));
        }
        elseif ($fieldInfo->FieldType == ftBlob)
            return '\'' . mysql_escape_string(file_get_contents($value)) . '\'';
        else
            return '\'' . $this->EscapeString($value) . '\'';
    }

    public function GetValueAsSQLString($value)
    {
        return '\'' . $this->EscapeString($value) . '\'';
    }

    public function EscapeString($string)
    {
        return str_replace('\'', '\'\'', $string);
    }

    public function GetFieldValueForInsert($fieldInfo, $value, $setToDefault)
    {
        if ($setToDefault)
            return 'DEFAULT';
        elseif ($value === null || (!isset($value)))
            return 'NULL';
        else
        {
            if (($fieldInfo->FieldType == ftNumber) && ($value === ''))
                return 'NULL';
            return $this->GetFieldValueAsSQL($fieldInfo, $value);
        }
    }

    public function GetFieldValueAsSQLForDelete($fieldInfo, $value)
    {
        if ($value == null || (!isset($value)))
            return 'NULL';
        else
        {
            if (($fieldInfo->FieldType == ftNumber) && ($value == ''))
                return 'NULL';
            return $this->GetFieldValueAsSQL($fieldInfo, $value);
        }
    }

    public function QuoteTableIndetifier($identifier)
    {
        return $identifier;
    }

    public function QuoteIndetifier($identifier)
    {
        return $identifier;
    }

    public function GetSetFieldValueClause($fieldInfo, $value, $default = false)
    {
        return $this->GetFieldFullName($fieldInfo) . ' = ' . $this->GetFieldValueAsSQLForUpdate($fieldInfo, $value, $default);
    }

    public function GetFieldValueAsSQLForUpdate($fieldInfo, $value, $default = false)
    {
        if (!isset($value))
        {
            if ($default)
                return 'DEFAULT';
            else
                return 'NULL';
        }
        else
        {
            if (($fieldInfo->FieldType == ftNumber) && ($value === ''))
                return 'NULL';
            return $this->GetFieldValueAsSQL($fieldInfo, $value);
        }
    }

    public function GetLimitClause($limitCount, $upLimit)
    {
        return "LIMIT $upLimit, $limitCount";
    }

    private function GetJoinKindAsSQL($joinKind)
    {
        switch ($joinKind)
        {
            case JoinKind::Inner:
                return 'INNER JOIN';
                break;
            case JoinKind::LeftOuter:
                return 'LEFT OUTER JOIN';
                break;
            default:
                return 'JOIN';
                break;
        }
    }

    public function CreateJoinClause($joinInfo)
    {
        return sprintf('%s %s%s ON %s = %s',
            $this->GetJoinKindAsSQL($joinInfo->JoinKind),
            $this->QuoteTableIndetifier($joinInfo->Table),
            $joinInfo->TableAlias != '' ? (' ' . $this->QuoteIndetifier($joinInfo->TableAlias)) : '',
            $this->QuoteIndetifier(isset($joinInfo->TableAlias) ? $joinInfo->TableAlias : $joinInfo->Table) . '.' . $this->QuoteIndetifier($joinInfo->LinkField),
            $this->GetFieldFullName($joinInfo->Field));
    }

    public function GetIsNullCoditition($fieldName)
    {
        return $fieldName . ' IS NULL';
    }

    public function ExecuteUpdateCommand($connection, $command)
    {
        $connection->ExecSQL($command->GetSQL());
    }

    public function ExecuteInsertCommand($connection, $command)
    {
        $connection->ExecSQL($command->GetSQL());
    }

    public function ExecuteCustomInsertCommand($connection, $command)
    {
        $connection->ExecSQL($command->GetSQL());
    }

    protected function DoExecuteSelectCommand($connection, $command)
    {
        //echo $command->GetSQL() . '<br>';
        $result = $this->connectionFactory->CreateDataset($connection, $command->GetSQL());
        $result->Open();
        return $result;
    }

    public function ExecuteReader(EngConnection $connection, $sql)
    {
        $result = $this->connectionFactory->CreateDataset($connection, $sql);
        $result->Open();
        return $result;
    }

    public function ExecuteSelectCommand($connection, $command)
    {
        $result = $this->DoExecuteSelectCommand($connection, $command);
        foreach($command->GetFields() as $fieldInfo)
            $result->AddFieldInfo($fieldInfo);
        return $result;
    }

    public function DoExecuteCustomSelectCommand($connection, $command)
    {
        $result = $this->connectionFactory->CreateDataset($connection, $command->GetSQL());
        $result->Open();
        return $result;
    }

    public function ExecuteCustomSelectCommand($connection, $command)
    {
        $result = $this->DoExecuteCustomSelectCommand($connection, $command);
        foreach($command->GetFields() as $fieldInfo)
            $result->AddFieldInfo($fieldInfo);
        return $result;
    }

    public function ExecutCustomUpdateCommand($connection, $command)
    {
        $connection->ExecSQL($command->GetSQL());
    }

    public function ExecuteCustomDeleteCommand($connection, $command)
    {
        $connection->ExecSQL($command->GetSQL());
    }

    public function ExecuteDeleteCommand($connection, $command)
    {
        $connection->ExecSQL($command->GetSQL());
    }

    public function GetAfterSelectSQL($command)
    {
        return '';
    }

    public function SupportsDefaultValue()
    {
        return true;
    }

    public function GetAggregationExpression($aggregate, $expression)
    {
        return StringUtils::Format('%s(%s)', Aggregate::AsSQL($aggregate), $expression);
    }
}

class EngCommand
{
    private $engCommandImp;

    public function __construct(EngCommandImp $engCommandImp)
    {
        $this->engCommandImp = $engCommandImp;
    }

    protected function GetCommandImp()
    {
        return $this->engCommandImp;
    }

    public function Execute(EngConnection $connection)
    { }
}


?>
