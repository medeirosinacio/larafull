<?php

namespace App\Components\Traits;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

trait LabelsTrait
{
    private Cache $cache;

    /** Set the name of the model attributes */
    protected array $attributeLabels;

    /**
     * LabelsTrait constructor.
     */
    public function __construct()
    {
        $this->cache = new Cache();
        $this->attributeLabels = $this->attributeLabels();

        if (!$this->hasCache($this->getTable()) || App::environment('local')) {

            $this->setLabelsWithDatabaseComment();
            $this->setLabelsWithClassMethod();
            $this->setLabelsWithColumnName();

            $this->setCache($this->getTable(), $this->attributeLabels);
        }

        $this->attributeLabels = $this->getCache($this->getTable());
    }

    /**
     * Get field name
     * @param string $field
     * @return string
     */
    public function label($field)
    {
        return $this->attributeLabels[$field] ??= '';
    }

    /**
     * @param string $key
     * @return string
     * @throws \ErrorException
     */
    public function getAttributeLabel($key)
    {
        if (!empty($this->attributeLabels[$key])) {
            return $this->attributeLabels[$key];
        }

        throw new \ErrorException("Column \"{$key}\" does not exist in the table \"{$this->getTable()}\"");

    }

    /**
     * @return array
     */
    public function getAttributeLabels()
    {
        return $this->attributeLabels ??= [];
    }

    /**
     * @param $columnName
     * @param $description
     */
    public function setAttributeLabel($columnName, $description)
    {
        $this->attributeLabels[$columnName] = $description;
    }

    private function attributeLabels()
    {
        return [
            'id' => 'ID'
        ];
    }

    /**
     * @param string $key
     * @param string|array $value
     * @param \DateTimeInterface|\DateInterval|int $ttl = null
     */
    private function setCache($key, $value, $ttl = null)
    {
        $labelKey = $this->getLabelKey($key);
        $this->cache::put($labelKey, json_encode($value), $ttl);
    }

    /**
     * @param string $key
     * @return string|array
     */
    private function getCache($key)
    {
        $labelKey = $this->getLabelKey($key);
        return json_decode($this->cache::get($labelKey), true);
    }

    /**
     * @param $key
     * @return bool
     */
    private function hasCache($key)
    {
        return !empty($this->getCache($key));
    }

    /**
     * @param string $field
     * @return string
     */
    private function getLabelKey($field)
    {
        return "labelstrait.{$this->getTable()}.$field";
    }

    /**
     * place labels with database information
     */
    private function setLabelsWithDatabaseComment()
    {
        $listFieldsInfo = DB::select('
                SELECT DISTINCT
                    a.attnum as num,
                    a.attname as name,
                    format_type(a.atttypid, a.atttypmod) as typ,
                    a.attnotnull as notnull,
                    com.description as description
                FROM pg_attribute a
                JOIN pg_class pgc ON pgc.oid = a.attrelid
                LEFT JOIN pg_index i ON
                    (pgc.oid = i.indrelid AND i.indkey[0] = a.attnum)
                LEFT JOIN pg_description com on
                    (pgc.oid = com.objoid AND a.attnum = com.objsubid)
                LEFT JOIN pg_attrdef def ON
                    (a.attrelid = def.adrelid AND a.attnum = def.adnum)
                WHERE a.attnum > 0 AND pgc.oid = a.attrelid
                AND pg_table_is_visible(pgc.oid)
                AND NOT a.attisdropped
                AND pgc.relname = :tablename
                ORDER BY a.attnum;', ['tablename' => $this->getTable()]);

        if ($listFieldsInfo) {
            foreach ($listFieldsInfo as $fieldInfo) {
                $this->setAttributeLabel($fieldInfo->name, $fieldInfo->description);
            }
        }
    }

    /**
     * place labels with class attributeLabels method
     */
    private function setLabelsWithClassMethod()
    {
        if ($this->attributeLabels) {
            foreach ($this->attributeLabels as $columnName => $description) {
                $this->setAttributeLabel($columnName, $description);
            }
        }
    }

    /**
     * place labels with column name
     */
    private function setLabelsWithColumnName()
    {
        if ($this->attributeLabels) {
            foreach ($this->attributeLabels as $col => $label) {
                if (empty($label)) {
                    $this->setAttributeLabel($col, $this->getAutoConvertLabel($col));
                }
            }
        }
    }

    /**
     * @param string $field
     * @return string
     */
    protected function getAutoConvertLabel($field)
    {
        return __(mb_ucfirst_fix(str_replace('_', ' ', strtolower($field))));
    }

}
