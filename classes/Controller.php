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
  protected function fetchAll($table_name)
  {
    // select all datas
    return $this->selectAll("$table_name");
  }
  protected function fetchAllDesc($table_name)
  {
    // select all datas
    return $this->selectAllDesc("$table_name");
  }
  protected function fetchAllDescLimit($table_name)
  {
    // select all datas
    return $this->selectAllDescLimit("$table_name");
  }
  protected function fetchWhereAnd($table_name, ...$params)
  {
    // Default values
    $limit = null;
    $unique = false; // Can be column name or false
    $where_clauses = [];

    // Loop through parameters to detect limit and unique values
    foreach ($params as $param) {
        if (is_int($param)) {
            $limit = $param; // Assign integer as limit
        } elseif (is_string($param) && count($where_clauses) == 0 && $unique === false) {
            $unique = $param; // First string is treated as unique column
        } else {
            $where_clauses[] = $param; // Collect conditions
        }
    }

    return $this->selectWhereAnd($table_name, $where_clauses, $limit, $unique);
  }
  protected function fetchWhereAndLimit($table_name, ...$where_clauses)
  {
    $where_array = array();
    foreach ($where_clauses as $where_clause) {
      $parts = explode('=', $where_clause);
      $key = trim($parts[0]);
      $value = trim($parts[1]);
      $where_array[$key] = $value;
    }

    return $this->selectWhereAndLimit($table_name, $where_array);
  }
  protected function fetchWhereAndDesc($table_name, ...$where_clauses)
  {
    $where_array = array();
    foreach ($where_clauses as $where_clause) {
      $parts = explode('=', $where_clause);
      $key = trim($parts[0]);
      $value = trim($parts[1]);
      $where_array[$key] = $value;
    }

    return $this->selectWhereAndDesc($table_name, $where_array);
  }
  protected function fetchWhereOr($table_name, ...$params)
  {
    // Default values
    $limit = null;
    $unique = false; // Can be column name or false
    $where_clauses = [];

    // Loop through parameters to detect limit and unique values
    foreach ($params as $param) {
      if (is_int($param)) {
        $limit = $param; // Assign integer as limit
      } elseif (is_string($param) && count($where_clauses) == 0 && $unique === false) {
        $unique = $param; // First string is treated as unique column
      } else {
        $where_clauses[] = $param; // Collect conditions
      }
    }

    return $this->selectWhereOr($table_name, $where_clauses, $limit, $unique);
  }
  protected function fetchWhereLikeOr($table_name, ...$params)
  {
    // Default values
    $limit = null;
    $unique = false; // Can be column name or false
    $where_clauses = [];

    // Loop through parameters to detect limit and unique values
    foreach ($params as $param) {
      if (is_int($param)) {
        $limit = $param; // Assign integer as limit
      } elseif (is_string($param) && count($where_clauses) == 0 && $unique === false) {
        $unique = $param; // First string is treated as unique column
      } else {
        $where_clauses[] = $param; // Collect conditions
      }
    }

    return $this->selectWhereOr($table_name, $where_clauses, $limit, $unique);
  }


  protected function fetchWhereLikeAnd($table_name, ...$params)
  {
    // Default values
    $limit = null;
    $unique = false; // Can be column name or false
    $where_clauses = [];

    // Loop through parameters to detect limit and unique values
    foreach ($params as $param) {
        if (is_int($param)) {
            $limit = $param; // Assign integer as limit
        } elseif (is_string($param) && count($where_clauses) == 0 && $unique === false) {
            $unique = $param; // First string is treated as unique column
        } else {
            $where_clauses[] = $param; // Collect conditions
        }
    }

    return $this->selectWhereAnd($table_name, $where_clauses, $limit, $unique);
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
  protected function fetchWhereLikeOperation($table_name, $operation, $column_name, ...$where_clauses)
  {
    $where_array = array();
    foreach ($where_clauses as $where_clause) {
      $parts = explode('=', $where_clause);
      $key = trim($parts[0]);
      $value = trim($parts[1]);
      $where_array[$key] = '%' . $value . '%';
    }

    return $this->selectWhereOperation($table_name, $where_array, $operation, $column_name);
  }



  protected function showDebitHistories()
  {
    return $this->selectDebitHistories();
  }
  protected function showDebitHistoryName($customer_name)
  {
    return $this->selectDebitHistoryName($customer_name);
  }
  protected function showDebitHistoryAddress($customer_name, $customer_address)
  {
    return $this->selectDebitHistoryAddress($customer_name, $customer_address);
  }

  protected function fetchWhereAndLimit50($table_name, ...$where_clauses)
  {
    $where_array = array();
    foreach ($where_clauses as $where_clause) {
      $parts = explode('=', $where_clause);
      $key = trim($parts[0]);
      $value = trim($parts[1]);
      $where_array[$key] = $value;
    }

    return $this->selectWhereAndLimit50($table_name, $where_array);
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

  protected function countPaginated($table_name)
  {
    return $this->countRecords($table_name);
  }

  protected function fetchJoinDesc($table1, $table2, $column)
  {
    return $this->selectJoinDesc($table1, $table2, $column);
  }
  protected function fetchWhereLikeAndJoin($table1, $table2, $column, ...$where_clauses)
  {
    return $this->selectWhereAndJoin($table1, $table2, $column, ...$where_clauses);
  }
  protected function trashWhereLikeAndJoin($table1, $table2, $column, ...$where_clauses)
  {
    return $this->deleteWhereAndJoin($table1, $table2, $column, ...$where_clauses);
  }
}
