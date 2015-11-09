<?php

class BaseModel {
	
	public function __construct() {
		
	}
	
	public function toArray() {
		return objectToArray($this);
	}
	
	public static function tableName() {
		return null;
	}
	
	protected static function getClassName() {
		return get_called_class();
	}
	
	protected static function selectRow($select = null, $where = null, $join = null) {
		return Application::$db->selectRow(static::tableName(), static::getClassName(), $select, $where, $join);
	}
	
	protected static function selectRows($select = null, $where = null, $join = null, $order = null, $range = null) {
		return Application::$db->selectRows(static::tableName(), static::getClassName(), $select, $where, $join, $order, $range);
	}
	
	protected static function delete($where = null) {
		return Application::$db->delete(static::tableName(), $where);
	}
	
	protected static function insertRow($fields, $values) {
		return Application::$db->insertRow(static::tableName(), $fields, $values);
	}
	
	protected static function insertRows($fields, $values) {
		return Application::$db->insertRows(static::tableName(), $fields, $values);
	}
	
	protected static function update($fields, $values, $where = null) {
		return Application::$db->update(static::tableName(), $fields, $values, $where);
	}
	
	protected static function column($field) {
		return Application::$db->column(static::tableName(), $field);
	}
	
	protected static function columns($table_name = null) {
		if (is_null($table_name)) $table_name = static::tableName();
		return Application::$db->columns($table_name);
	}
	
	protected static function addColumn($column, $type, $mandatory = true, $table_name = null) {
		if (is_null($table_name)) $table_name = static::tableName();
		return Application::$db->addColumn($table_name, $column, $type, $mandatory);
	}
	
	protected static function dropColumn($column, $table_name = null) {
		if (is_null($table_name)) $table_name = static::tableName();
		return Application::$db->dropColumn($table_name, $column);
	}
	
	protected static function table($table_name) {
		return Application::$db->tableName($table_name);
	}
	
	protected static function field($field, $table_name = null, $as = null) {
		if (is_null($table_name)) $table_name = static::tableName();
		return static::table($table_name) . '.' . $field . (is_null($as) ? '' : ' as ' . $as);
	}
	
	protected static function where($array, $comparison = 'and') {
		return ' ( ' . DataBaseManager::where($array, $comparison) . ' ) ';
	}
	
	protected static function inner($joinParam, $joinTable, $destParam, $destTable = null) {
		if (is_null($destTable)) $destTable = static::tableName();
		return 'inner join ' . static::table($joinTable) . ' on ' . static::table($destTable) . '.' . $destParam . '=' . static::table($joinTable) . '.' . $joinParam;
	}
	
}

?>