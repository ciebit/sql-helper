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
        $sql->addBind('key', PDO::PARAM_STR, 'value')
            ->addFilterBy('field_1', PDO::PARAM_STR, '=', 'value')
            ->addFilterBy('field_2', PDO::PARAM_STR, '=', 'value1', 'value2', 'value3')
            ->addOrderBy('field_1', 'ASC')
            ->addSqlFilter('field_3 = 3')
            ->addSqlJoin('LEFT JOIN `table_02` ON `table_01`.`field_01` = `table_02`.`field_02`')
            ->setLimit(5)
            ->setOffset(2);

        $this->assertTrue(true);
        $this->assertEquals('LIMIT 2,5', $sql->generateSqlLimit());
        $this->assertEquals(
            'field_1 = :value_0 AND field_2 IN (:value_1,:value_2,:value_3) AND field_3 = 3', 
            $sql->generateSqlFilters()
        );
        $this->assertEquals(
            'LEFT JOIN `table_02` ON `table_01`.`field_01` = `table_02`.`field_02`', 
            $sql->generateSqlJoin()
        );
        $this->assertEquals('ORDER BY field_1 ASC', $sql->generateSqlOrder());
    }
}
