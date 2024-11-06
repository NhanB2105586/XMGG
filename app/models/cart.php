<?php

namespace App\Models;

use PDO;

class Cart
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    // Thêm sản phẩm vào giỏ hàng
    public function addProduct($userId, $productId, $quantity)
    {
        // Kiểm tra xem người dùng đã có giỏ hàng chưa
        $stmt = $this->db->prepare("SELECT cart_id FROM carts WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        $cart = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$cart) {
            // Tạo giỏ hàng mới nếu chưa có
            $stmt = $this->db->prepare("INSERT INTO carts (user_id) VALUES (:user_id)");
            $stmt->execute(['user_id' => $userId]);
            $cartId = $this->db->lastInsertId();
        } else {
            $cartId = $cart['cart_id'];
        }

        // Kiểm tra sản phẩm đã có trong giỏ hàng chưa
        $stmt = $this->db->prepare("SELECT * FROM cart_items WHERE cart_id = :cart_id AND product_id = :product_id");
        $stmt->execute(['cart_id' => $cartId, 'product_id' => $productId]);
        $cartItem = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($cartItem) {
            // Nếu sản phẩm đã tồn tại trong giỏ, cập nhật số lượng
            $newQuantity = $cartItem['quantity'] + $quantity;
            $stmt = $this->db->prepare("UPDATE cart_items SET quantity = :quantity WHERE cart_id = :cart_id AND product_id = :product_id");
            $stmt->execute(['quantity' => $newQuantity, 'cart_id' => $cartId, 'product_id' => $productId]);
        } else {
            // Thêm sản phẩm mới vào giỏ
            $stmt = $this->db->prepare("INSERT INTO cart_items (cart_id, product_id, quantity) VALUES (:cart_id, :product_id, :quantity)");
            $stmt->execute(['cart_id' => $cartId, 'product_id' => $productId, 'quantity' => $quantity]);
        }
        // Cập nhật lại số lượng tồn kho của sản phẩm
        $stmt = $this->db->prepare("UPDATE products SET in_stock = in_stock - :quantity WHERE product_id = :product_id");
        $stmt->execute(['quantity' => $quantity, 'product_id' => $productId]);
    }

    // Lấy danh sách sản phẩm trong giỏ hàng
    public function getCartItems($userId)
    {
        $stmt = $this->db->prepare("
        SELECT p.product_name, p.price, ci.quantity, pi.image_url, p.product_id
        FROM cart_items ci
        JOIN products p ON ci.product_id = p.product_id
        LEFT JOIN product_images pi ON p.product_id = pi.product_id
        JOIN carts c ON ci.cart_id = c.cart_id
        WHERE c.user_id = :user_id
        GROUP BY p.product_id
    ");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Xóa một sản phẩm khỏi giỏ hàng và cập nhật lại tồn kho
    public function removeProduct($cartId, $productId)
    {
        // Lấy số lượng sản phẩm hiện có trong giỏ hàng trước khi xóa
        $stmt = $this->db->prepare("SELECT quantity FROM cart_items WHERE cart_id = :cart_id AND product_id = :product_id");
        $stmt->execute(['cart_id' => $cartId, 'product_id' => $productId]);
        $cartItem = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($cartItem) {
            $quantity = $cartItem['quantity'];

            // Xóa sản phẩm khỏi giỏ hàng
            $stmt = $this->db->prepare("DELETE FROM cart_items WHERE cart_id = :cart_id AND product_id = :product_id");
            $stmt->execute(['cart_id' => $cartId, 'product_id' => $productId]);

            // Cập nhật lại tồn kho của sản phẩm
            $stmt = $this->db->prepare("UPDATE products SET in_stock = in_stock + :quantity WHERE product_id = :product_id");
            $stmt->execute(['quantity' => $quantity, 'product_id' => $productId]);
        }
    }


    public function getCartByUserId($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM carts WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function updateQuantity($userId, $productId, $quantity)
    {
        // Lấy cart_id của người dùng
        $cart = $this->getCartByUserId($userId);
        if ($cart) {
            $stmt = $this->db->prepare("UPDATE cart_items SET quantity = :quantity WHERE cart_id = :cart_id AND product_id = :product_id");
            $stmt->execute([
                'quantity' => $quantity,
                'cart_id' => $cart['cart_id'],
                'product_id' => $productId
            ]);
        }
    }

    public function getProductCountByUserId($userId)
    {
        $stmt = $this->db->prepare("
        SELECT COUNT(DISTINCT ci.product_id) AS product_count
        FROM cart_items ci
        JOIN carts c ON ci.cart_id = c.cart_id
        WHERE c.user_id = :user_id
    ");
        $stmt->execute(['user_id' => $userId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['product_count'] ?? 0;
    }

    public function getProductById($productId)
    {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE product_id = :product_id");
        $stmt->execute(['product_id' => $productId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateInStock($productId, $newStock)
    {
        $stmt = $this->db->prepare("UPDATE products SET in_stock = :in_stock WHERE product_id = :product_id");
        $stmt->execute(['in_stock' => $newStock, 'product_id' => $productId]);
    }


    public function getCurrentQuantityInCart($userId, $productId)
    {
        $stmt = $this->db->prepare("
        SELECT quantity FROM cart_items
        JOIN carts ON cart_items.cart_id = carts.cart_id
        WHERE carts.user_id = :user_id AND cart_items.product_id = :product_id
    ");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['quantity'] ?? 0;
    }


    public function clearCart($userId)
    {
        // Lấy cart_id của người dùng
        $stmt = $this->db->prepare("SELECT cart_id FROM carts WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        $cart = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($cart) {
            $cartId = $cart['cart_id'];

            // Xóa tất cả sản phẩm trong cart_items dựa trên cart_id
            $stmt = $this->db->prepare("DELETE FROM cart_items WHERE cart_id = :cart_id");
            $stmt->execute(['cart_id' => $cartId]);
        }
    }


}
