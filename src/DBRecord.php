<?php

namespace Averkov\Cirno;

/**
 * A database table record
 */
class DBRecord extends CirnoObject implements ArrayAccess
{
	/**
	 * Имя таблички, хранящей объекты данного типа
	 */
	protected $table = '';

	/**
	 * Row of data as an array
	 */
	protected $row = [];

	/**
	 * List of the fields that make a primary key (or NULL if there is no primary key)
	 */
	protected $pk_fields = NULL;

	/**
	 * Values of the primary key fields
	 */
	protected $pk = [];

	/**
	 * URL of the web page representing current row
	 */
	protected $url = '';

	/**
	 * Values for boolean fields (i.e 1/0, on/off, yes/no)
	 */
	protected $booleans = ['on', 'off'];

	/**
	 * Префикс имён полей объектов данного типа
	 */
	protected $prefix = '';

	/**
	 * Флаг «свежести» объекта, т.е объект ещё не был сохранён в БД
	 */
	protected $fresh = false;

	/**
	 * Конструктор. Таблица может иметь первичный ключ, состоящий из колонок $pk_fields, в этом случае будет работать сохранение
	 */
	public function __construct(DB $db, string $table, array $row, ?array $pk_fields = NULL, bool $fresh = false) {
		parent::__construct($db->getCirno());
		$this->db = $db;
		$this->table = $table;
		$this->row = $row;
		$this->pk_fields = $pk_fields;
		$this->fresh = $fresh;

		// Если указаны столбцы, формирующие естественный первичный ключ, отметим это
		if(is_array($pk_fields) && count($pk_fields)) {
			foreach($pk_fields as $pk_part_field) {
				$this->pk[$pk_part_field] = & $this->row[$pk_part_field];
			}
		}
	}

	/**
	 * Сохранить запись
	 * @return int всегда 0
	 */
	public function save(): int {
		// Подготовим данные для записи, убирая лишнее, что могло быть подтянуто из других таблиц
		$table_columns = array_flip($this->db->getFieldList($this->table));
		$row = array_intersect_key($this->row, $table_columns);

		if($this->fresh) {
			// Запишем данные
			$this->db->insertQuoted($this->table, $row, true);

			// Пометим, что объект уже не новый
			$this->fresh = false;
		} else {
			// Построим условие выборки
			$where = [];
			foreach($this->pk as $field => $value) {
				$where[] = "$field = " . $this->db->quote($value);
			}

			// Запишем модификации
			$this->db->updateQuoted($this->table, $row, implode(' AND ', $where));
		}

		return 0;
	}

	public function remove() {
		// Невозможно удалить новую запись, которая и так ещё не в БД
		if($this->fresh) return false;

		// Не можем удалить непонятно что
		if(!count($this->pk)) return false;

		// Построим условие
		$where = [];
		/*foreach($this->pk as $field => $value) {
			$where[] = "$field = " . $this->db->quote($value);
		}

		// Запишем модификации
		$this->db->delete($this->table, implode(' AND ', $where));*/

		// Удаление успешно
		return true;
	}

	public function isNew(): bool {
		return $this->fresh;
	}

	/**
	 * Проверить существование поля с индексом $offset
	 * @param mixed $offset проверяемый индекс
	 * @return bool существует ли поле с таким индексом
	 */
	public function offsetExists(mixed $offset): bool {
		return isset($this->row[$offset]);
	}

	/**
	 * Вернуть значение поля с индексом $offset
	 * @param mixed $offset индекс элемента
	 * @return mixed значение элемента
	 */
	public function offsetGet(mixed $offset): mixed {
		return $this->row[$offset];
	}

	/**
	 * Установить поле с индексом $offset в значение $value
	 * @param mixed $offset индекс элемента
	 * @param mixed $value требуемое значение
	 */
	public function offsetSet(mixed $offset, mixed $value): void {
		$this->row[$offset] = $value;
	}

	/**
	 * Remove the item $offset
	 * @param mixed $offset item index
	 */
	public function offsetUnset(mixed $offset): void {
		unset($this->row[$offset]);
	}

	/**
	 * Set the URL of the entity's web page
	 */
	public function setWebPage($url) {
		$this->url = $url;
	}

	/**
	 * Get the URL of the entity's web page
	 */
	public function href() {
		return $this->url;
	}

	/**
	 * Redirect the browser to the entity's page
	 */
	public function go($send_header = false) {
		// TODO
	}

	/**
	 * Set values to be used in boolean fields 
	 */
	public function setBooleanValues($true_placeholder, $false_placeholder) {
		$this->booleans = [$true_placeholder, $false_placeholder];
	}

	/**
	 * Set field name prefix
	 */
	public function setPrefix(string $prefix) {
		$this->prefix = $prefix;
	}
}
