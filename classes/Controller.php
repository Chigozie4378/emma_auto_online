<?php
class Controller extends Model
{

  protected function insert($table_name, ...$values)
  {
    $data_array = array();

    // Add null as the first value
    $data_array[] = null;

    // Add the remaining values to the data array
    foreach ($values as $value) {
      $data_array[] = $value;
    }

    // Insert the data into the table
    $this->insertData($table_name, array($data_array));
  }
  public function fetchResult($table_name, $where = [], ...$options)
{
    if (!is_array($where)) {
        array_unshift($options, $where);
        $where = [];
    }

    $defaults = [
        "oper" => [],
        "log" => [],
        "cols" => "*",
        "distinct" => null,
        "additional" => null,
        "order_by" => null,
        "group_by" => null,
        "having" => null,
        "limit" => null,
        "join" => []
    ];

    $options = array_merge($defaults, $options);

    return $this->selectQuery(
        $table_name,
        $where,
        $options["oper"],
        $options["log"],
        $options["cols"],
        $options["distinct"],
        $options["additional"],
        $options["order_by"],
        $options["group_by"],
        $options["having"],
        $options["limit"],
        $options["join"]
    );
}

  


  protected function trashWhere($table_name, ...$where_clauses)
  {
    $where_array = array();
    foreach ($where_clauses as $where_clause) {
      $parts = explode('=', $where_clause);
      $key = trim($parts[0]);
      $value = trim($parts[1]);
      $where_array[$key] = $value;
    }

    return $this->deleteWhere($table_name, $where_array);
  }


  protected function updates($table, $update_columns, $where_columns)
  {
    $this->updateData($table, $update_columns, $where_columns);
  }
 



  protected function lockInvoice()
  {
    $this->invoiceLock();
  }
  protected function unlockInvoice()
  {
    $this->invoiceUnlock();
  }

  protected function getPaginated($table_name, $offset, $records_per_page)
  {
    return $this->selectPagination($table_name, $offset, $records_per_page);
  }

  protected function trashWhereLikeAndJoin($table1, $table2, $column, ...$where_clauses)
  {
    return $this->deleteWhereAndJoin($table1, $table2, $column, ...$where_clauses);
  }
}
