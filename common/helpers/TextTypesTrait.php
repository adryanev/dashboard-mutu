<?php


namespace common\helpers;


use yii\db\ColumnSchemaBuilder;

trait TextTypesTrait
{
    /**
     * @return \yii\db\Connection the database connection to be used for schema building.
     */
    protected abstract function getDb();

    /**
     * Creates a medium text column.
     * @return ColumnSchemaBuilder the column instance which can be further customized.
     * @throws \yii\base\NotSupportedException
     */
    public function mediumText()
    {
        return $this->getDb()->getSchema()->createColumnSchemaBuilder('mediumtext');
    }

    /**
     * Creates a long text column.
     * @return ColumnSchemaBuilder the column instance which can be further customized.
     * @throws \yii\base\NotSupportedException
     */
    public function longText()
    {
        return $this->getDb()->getSchema()->createColumnSchemaBuilder('longtext');
    }

    /**
     * Creates a tiny text column.
     * @return ColumnSchemaBuilder the column instance which can be further customized.
     * @throws \yii\base\NotSupportedException
     */
    public function tinyText()
    {
        return $this->getDb()->getSchema()->createColumnSchemaBuilder('tinytext');
    }
}