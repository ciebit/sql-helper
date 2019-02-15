<?php
namespace Ciebit\SqlHelper\Test;

use Ciebit\SqlHelper\Sql;
use PDO;
use PHPUnit\Framework\TestCase;

class SqlTest extends TestCase
{

    public function testMethodsWithParams()
    {
        $sql = new Sql;
        $sql->addBind('key', PDO::PARAM_STR, 'value');
        $sql->addFilterBy('field_1', PDO::PARAM_STR, '=', 'value');
        $sql->addFilterBy('field_2', PDO::PARAM_STR, '=', 'value1', 'value2', 'value3');
        $sql->addOrderBy('field_1', 'ASC');
        $sql->addSqlFilter('field_3 = 3');
        $sql->addSqlJoin('LEFT JOIN `table_02` ON `table_01`.`field_01` = `table_02`.`field_02`');

        $this->assertTrue(true);
    }
}
