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
        if (!isset($_SESSION['user_id'])) {
            new Redirect('sign_in');
            exit();
        }
        $user_id = $_SESSION['user_id'];
        $cart = $_SESSION['cart'] ?? [];
        if (empty($cart)) {
            header("Location: cart");
            exit();
        }


        // Insert order into database
        $invoice_no = $this->generateInvoiceNumber();
        $total_amount = array_sum(array_map(fn($item) => $item['quantity'] * $item['price'], $cart));
        do {
            $unique_id = uniqid();
            $hash = md5($unique_id);
            $order_id = substr($hash, 0, 30);

            // Check if the ID already exists in the database
            $row = $this->fetchResult("online_orders", where: ["order_id = $order_id"]);
        } while (mysqli_num_rows($row) > 0);

        $this->insert('orders', $user_id, $order_id, $invoice_no, $total_amount, "pending");
        // Insert order items
        foreach ($cart as $item) {
            $row = $this->fetchResult("online_order_details", where: ["order_id = $order_id"]);
        }

        // Clear the cart
        unset($_SESSION['cart']);
        new Redirect('invoice?invoice_no=$invoice_no');
        exit();
    }

    public function orders()
    {

        if (!isset($_SESSION['user_id'])) {
            new Redirect('sign_in');
            exit();
        }

        $user_id = $_SESSION['user_id'];
        return $this->fetchResult("online_orders", "user_id=$user_id", order_by: "created_at DESC");
    }
    public function invoice()
    {

        if (!isset($_GET['oid'])) {
            die("Invalid request.");
        }

        $oid = $_GET['oid'];

        return $this->fetchResult("online_orders", join: [
            "online_order_details" => "online_orders.order_id = online_order_details.order_id"],
        where:["online_orders.order_id=$oid"]);
    }
}