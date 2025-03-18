<?php
class OrdersController extends Controller
{
    public function generateInvoiceNumber()
    {
        do {
            $invoice_no = "INV-" . strtoupper(bin2hex(random_bytes(4)));
            $select = $this->fetchResult("online_orders", ["invoice_no=$invoice_no"], columns: "COUNT(*) AS count");
            $check = $select->num_rows;
        } while ($check > 0);

        return $invoice_no;
    }
    public function checkout()
    {
        // Ensure the user is logged in
        if (!isset($_SESSION['user_id'])) {
            new Redirect('sign_in');
            exit();
        }
        
        $user_id = $_SESSION['user_id'];
        $cart = $_SESSION['cart'] ?? [];
    
        // Redirect to cart if empty
        if (empty($cart)) {
            header("Location: cart");
            exit();
        }
    
        // Generate a unique invoice number
        $invoice_no = $this->generateInvoiceNumber();
    
        // Calculate total order amount
        $total_amount = array_sum(array_map(fn($item) => $item['quantity'] * $item['price'], $cart));
    
        // Generate a unique order ID
        do {
            $unique_id = uniqid();
            $hash = md5($unique_id);
            $order_id = substr($hash, 0, 30);
    
            // ✅ Ensure order_id is treated as a string in SQL
            $row = $this->fetchResult("online_orders", ["order_id" => "'$order_id'"]);
    
        } while (mysqli_num_rows($row) > 0); // Ensure it's unique
    
        // Insert order into `online_orders`
        $this->insert('online_orders',  $user_id, $order_id, $invoice_no, $total_amount, "pending", date("Y-m-d H:i:s"));
    
        // Insert each item into `online_order_details`
        foreach ($cart as $item) {
            $this->insert('online_order_details',  $order_id, $item['id'], $item['quantity'], $item['price'], $item['quantity'] * $item['price']);
        }
    
        // Clear the cart
        unset($_SESSION['cart']);
    
        // Redirect to invoice page
        new Redirect("invoice?oid=" . urlencode($order_id));
        exit();
    }
    
    


    public function order()
    {

        if (!isset($_SESSION['user_id'])) {
            new Redirect('sign_in');
            exit();
        }

        $user_id = $_SESSION['user_id'];
        return $this->fetchResult("online_orders", "user_id=$user_id", order_by: "created_at DESC");
    }
    public function orders()
    {

        if (!isset($_GET['oid'])) {
            die("Invalid request.");
        }

        $oid = $_GET['oid'];

        return $this->fetchResult(
            "online_orders",
            join: [
                "online_users" => "online_orders.user_id = online_users.user_id"
            ],
            where: ["online_orders.order_id=$oid"]
        );
    }
    public function orderDetails()
    {

        if (!isset($_GET['oid'])) {
            die("Invalid request.");
        }

        $oid = $_GET['oid'];

        return $this->fetchResult(
            "online_order_details",
            join: [
                "online_orders" => "online_order_details.order_id = online_orders.order_id",
                "online_products" => "online_order_details.product_id = online_products.product_id",
                "online_users" => "online_orders.user_id = online_users.user_id"
            ],
            where: ["online_orders.order_id=$oid"]
        );
    }
}