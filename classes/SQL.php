<?php
class SQL extends Controller
{

    public function sqlUsage()
{
    // 1️⃣ Fetch All Products
    $this->fetchResult("products");
    // SQL: SELECT * FROM products

    // 2️⃣ Fetch Specific Columns
    $this->fetchResult("products", columns: "id, name, price");
    // SQL: SELECT id, name, price FROM products

    // 3️⃣ Fetch Products in a Specific Category
    $this->fetchResult("products", where: ["category_id=3"]);
    // SQL: SELECT * FROM products WHERE category_id = 3

    // 4️⃣ Fetch Products With Multiple Categories
    $this->fetchResult("products", where: ["category_id=[1,2,3]"], oper: ["IN"]);
    // SQL: SELECT * FROM products WHERE category_id IN (1,2,3)

    // 5️⃣ Fetch Products Within a Price Range
    $this->fetchResult("products", where: ["price=[100,500]"], oper: ["BETWEEN"]);
    // SQL: SELECT * FROM products WHERE price BETWEEN 100 AND 500

    // 6️⃣ Fetch Products Containing a Keyword in Name (LIKE auto adds %)
    $this->fetchResult("products", where: ["name=laptop"], oper: ["LIKE"]);
    // SQL: SELECT * FROM products WHERE name LIKE '%laptop%'

    // 7️⃣ Fetch Products Matching Multiple LIKE Conditions
    $this->fetchResult("products", where: ["name=laptop", "brand=hp"], oper: ["LIKE", "LIKE"]);
    // SQL: SELECT * FROM products WHERE name LIKE '%laptop%' AND brand LIKE '%hp%'

    // 8️⃣ Fetch Products Matching Multiple WHERE Conditions (AND is Default)
    $this->fetchResult("products", where: ["category_id=3", "status=active"]);
    // SQL: SELECT * FROM products WHERE category_id = 3 AND status = 'active'

    // 9️⃣ Fetch Products Matching OR Conditions
    $this->fetchResult("products", where: ["category_id=3", "status=active"], log: ["OR"]);
    // SQL: SELECT * FROM products WHERE (category_id = 3 OR status = 'active')

    // 🔟 Fetch Products With Nested AND & OR Conditions
    $this->fetchResult("products", where: [
        "category_id=3",
        "status=active",
        "brand=Apple"
    ], log: ["AND", "OR"]);
    // SQL: SELECT * FROM products WHERE (category_id = 3 AND (status = 'active' OR brand = 'Apple'))

    // 1️⃣1️⃣ Fetch Products With ORDER BY
    $this->fetchResult("products", where: ["status=active"], order_by: "price DESC");
    // SQL: SELECT * FROM products WHERE status = 'active' ORDER BY price DESC

    // 1️⃣2️⃣ Fetch Distinct Product Models
    $this->fetchResult("products", distinct: "model");
    // SQL: SELECT DISTINCT model FROM products

    // 1️⃣3️⃣ Fetch Top 10 Most Expensive Products
    $this->fetchResult("products", order_by: "price DESC", limit: 10);
    // SQL: SELECT * FROM products ORDER BY price DESC LIMIT 10

    // 1️⃣4️⃣ Fetch Newly Added Products (Last 7 Days)
    $this->fetchResult("products", where: ["created_at=NOW() - INTERVAL 7 DAY"], oper: [">="]);
    // SQL: SELECT * FROM products WHERE created_at >= NOW() - INTERVAL 7 DAY

    // 1️⃣5️⃣ Fetch Products Grouped by Brand
    $this->fetchResult("products", columns: "brand, COUNT(*) AS count", group_by: "brand");
    // SQL: SELECT brand, COUNT(*) AS count FROM products GROUP BY brand

    // 1️⃣6️⃣ Fetch Orders With Customer Info (INNER JOIN)
    $this->fetchResult("orders", join: [
        "customers" => "orders.customer_id = customers.id"
    ]);
    // SQL: SELECT * FROM orders INNER JOIN customers ON orders.customer_id = customers.id

    // 1️⃣7️⃣ Fetch Orders With Order Items (LEFT JOIN)
    $this->fetchResult("orders", join: [
        "order_items" => "orders.id = order_items.order_id",
        "type" => "LEFT"
    ]);
    // SQL: SELECT * FROM orders LEFT JOIN order_items ON orders.id = order_items.order_id

    // 1️⃣8️⃣ Fetch Customers Who Have NOT Made Any Purchases (LEFT JOIN + NULL Check)
    $this->fetchResult("customers", join: [
        "orders" => "customers.id = orders.customer_id",
        "type" => "LEFT"
    ], where: ["orders.id=NULL"]);
    // SQL: SELECT * FROM customers LEFT JOIN orders ON customers.id = orders.customer_id WHERE orders.id IS NULL

    // 1️⃣9️⃣ Fetch Total Sales Per Category (JOIN + GROUP BY)
    $this->fetchResult("categories", columns: "categories.id, categories.name, SUM(orders.total_amount) AS total_sales",
        group_by: "categories.id", join: [
            "products" => "categories.id = products.category_id",
            "order_items" => "products.id = order_items.product_id",
            "orders" => "order_items.order_id = orders.id"
        ]
    );
    // SQL: SELECT categories.id, categories.name, SUM(orders.total_amount) AS total_sales FROM categories
    // INNER JOIN products ON categories.id = products.category_id
    // INNER JOIN order_items ON products.id = order_items.product_id
    // INNER JOIN orders ON order_items.order_id = orders.id
    // GROUP BY categories.id

    // 2️⃣0️⃣ Fetch Customers Spending More Than $1000 (HAVING Condition)
    $this->fetchResult("customers",
        columns: "customers.id, customers.name, SUM(orders.total_amount) AS total_spent",
        group_by: "customers.id",
        order_by: "total_spent DESC",
        join: ["orders" => "customers.id = orders.customer_id"],
        where: ["SUM(orders.total_amount)=1000"],
        oper: [">="]
    );
    // SQL: SELECT customers.id, customers.name, SUM(orders.total_amount) AS total_spent FROM customers
    // INNER JOIN orders ON customers.id = orders.customer_id
    // GROUP BY customers.id
    // HAVING total_spent >= 1000
    // ORDER BY total_spent DESC
}

}