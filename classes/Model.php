<?php
class Model extends DB
{
    function __construct()
    {
        $this->connect();
    }

    function __destruct()
    {
        $this->closeConnection();
    }


    protected function closeConnection()
    {
        $dbconn = $this->connect();
        if ($dbconn) {
            $dbconn->close();
        }
    }
    protected function insertData($table_name, $data_array)
    {

        $dbconn = $this->connect();
        // Build query string
        $query = "INSERT INTO $table_name VALUES (";
        $query .= str_repeat('?,', count($data_array[0]));
        $query = rtrim($query, ',');
        $query .= ")";

        // Prepare the statement
        $stmt = $dbconn->prepare($query);

        // Bind parameters
        $types = '';
        foreach ($data_array[0] as $value) {
            if (is_int($value)) {
                $types .= 'i';
            } elseif (is_double($value)) {
                $types .= 'd';
            } else {
                $types .= 's';
            }
        }
        $stmt->bind_param($types, ...array_values($data_array[0]));

        // Execute the statement for each set of data
        foreach ($data_array as $data) {
            $stmt->execute();
            if ($stmt->error) {
                die("Error: " . $stmt->error . $data);
            }
        }

        // Close statement and connection
        $stmt->close();
    }

    protected function selectQuery(
        $table_name,
        $where_conditions = [],
        $operators = [],
        $logicals = [],
        $cols = "*",
        $distinct = null,
        $additional = null,
        $order_by = null,
        $group_by = null,
        $having = null,
        $limit = null,
        $join = []
    ) {
        $dbconn = $this->connect();
        $queryParts = [];

        // DISTINCT Handling
        $selectClause = "SELECT " . ($distinct ? "DISTINCT $distinct" : $cols);
        $queryParts[] = "$selectClause FROM $table_name";

        // JOIN Handling
        if (!empty($join)) {
            foreach ($join as $table => $condition) {
                if ($table === "type")
                    continue;
                $joinType = strtoupper($join["type"] ?? "INNER");
                $queryParts[] = "$joinType JOIN $table ON $condition";
            }
        }

        // WHERE Conditions
        $whereClause = $this->formatWhereConditions($where_conditions, $operators, $logicals);
        if (!empty($whereClause)) {
            $queryParts[] = "WHERE $whereClause";
        }

        // GROUP BY, HAVING, ORDER BY
        if (!empty($group_by))
            $queryParts[] = "GROUP BY $group_by";
        if (!empty($having))
            $queryParts[] = "HAVING $having";
        if (!empty($order_by))
            $queryParts[] = "ORDER BY $order_by";

        // LIMIT
        if (!empty($limit)) {
            $queryParts[] = "LIMIT ?";
            $limitValue = $limit;
        }

        // Final SQL Query
        $query = implode(" ", $queryParts);
        $stmt = $dbconn->prepare($query);

        if (!$stmt) {
            throw new Exception("Database error: " . $dbconn->error);
        }

        // Execute Query
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result;
    }

    /**
     * Formats WHERE conditions properly
     */
    public function formatWhereConditions($where_conditions, $comparison_operators = [], $logical_operators = [])
    {
        if (empty($where_conditions))
            return "";

        $formatted_conditions = [];
        $index = 0;

        foreach ($where_conditions as $condition) {
            $operator = isset($comparison_operators[$index]) ? strtoupper($comparison_operators[$index]) : "=";
            $logical_operator = $index > 0 ? (isset($logical_operators[$index - 1]) ? strtoupper($logical_operators[$index - 1]) : "AND") : "";

            // Extract column and value
            if (preg_match('/^(.+?)=(.+)$/', $condition, $matches)) {
                $column = trim($matches[1]);  // Trim column name
                $value = trim($matches[2]);   // Trim value (Removes leading spaces)

                // If LIKE, ensure proper quotes & % placement
                if ($operator == "LIKE") {
                    $value = "'%" . $value . "%'";  // Properly place % inside single quotes
                }
                // Ensure the value is wrapped in single quotes for SQL safety (except NULL, IN, BETWEEN)
                elseif (!is_numeric($value) && !preg_match('/NULL|IN|BETWEEN/i', $operator)) {
                    $value = "'$value'";
                }

                $condition = "$column $operator $value";
            }

            // Append logical operator if necessary
            if ($logical_operator) {
                $formatted_conditions[] = "$logical_operator ($condition)";
            } else {
                $formatted_conditions[] = $condition;
            }

            $index++;
        }

        return implode(" ", $formatted_conditions);
    }


    protected function deleteWhere($table_name, $where_array)
    {
        $dbconn = $this->connect();

        // Build query string
        $query = "DELETE FROM $table_name WHERE ";
        $where_clause = array();
        foreach ($where_array as $key => $value) {
            $where_clause[] = "$key = ?";
        }
        $query .= implode(" AND ", $where_clause);

        // Prepare the statement
        $stmt = $dbconn->prepare($query);

        // Bind parameters
        $types = "";
        foreach ($where_array as $value) {
            if (is_int($value)) {
                $types .= "i";
            } elseif (is_double($value)) {
                $types .= "d";
            } else {
                $types .= "s";
            }
        }
        $stmt->bind_param($types, ...array_values($where_array));

        // Execute the statement
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Close statement and connection
        $stmt->close();


        // Return the result object
        return $result;
    }

    protected function updateData($table, $update_columns, $where_columns)
    {
        $dbconn = $this->connect();
        // Construct the SQL query
        $sql = "UPDATE $table SET ";

        $update_values = array();
        foreach ($update_columns as $column_name => $new_value) {
            $sql .= "$column_name = ?, ";
            $update_values[] = $new_value;
        }
        // Remove the trailing comma and space
        $sql = rtrim($sql, ', ');

        // Append the WHERE clause to the SQL query
        if (!empty($where_columns)) {
            $sql .= " WHERE ";
            $where_values = array();
            foreach ($where_columns as $column_name => $old_value) {
                $sql .= "$column_name = ? AND ";
                $where_values[] = $old_value;
            }
            // Remove the trailing "AND" and space
            $sql = rtrim($sql, 'AND ');
            $update_values = array_merge($update_values, $where_values);
        }

        // Prepare and execute the SQL query
        $stmt = $dbconn->prepare($sql);

        // Create types string for bind_param based on the types of the update_values
        $types = '';
        foreach ($update_values as $value) {
            if (is_numeric($value)) {
                $types .= 'i';
            } else {
                $types .= 's';
            }
        }

        // Bind the parameters with types
        $stmt->bind_param($types, ...array_values($update_values));
        $stmt->execute();

        // Close statement and connection
        $stmt->close();
    }


    protected function invoiceLock()
    {
        $dbconn = $this->connect();
        $stmt = $dbconn->prepare("SELECT * FROM sales FOR UPDATE");
        $stmt->execute();
        $stmt->close();
    }
    protected function invoiceUnlock()
    {
        $dbconn = $this->connect();
        $stmt = $dbconn->prepare("UNLOCK TABLES");
        $stmt->execute();
        $stmt->close();
    }
    protected function selectPagination($table_name, $offset, $records_per_page)
    {
        $sql = "SELECT * FROM $table_name LIMIT $records_per_page OFFSET $offset";
        $result = $this->connect()->query($sql);
        return $result;
    }



    protected function deleteWhereAndJoin($table1, $table2, $column, ...$where_clauses)
    {
        $dbconn = $this->connect();

        // Construct the subquery

        $subquery = "SELECT * FROM $table1
        JOIN $table2 ON $table1.$column = $table2.$column";

        if (!empty($where_clauses)) {
            $subquery .= " WHERE ";
            $subquery .= implode(" AND ", $where_clauses);
        }

        // Prepare DELETE query using a prepared statement
        $query = "DELETE FROM $table1 WHERE $column IN ($subquery)";
        $stmt = $dbconn->prepare($query);

        if ($stmt) {
            // Execute the prepared statement
            $stmt->execute();
            $stmt->close();
        } else {
            echo "Query preparation failed: " . $dbconn->error;
        }


    }
}
