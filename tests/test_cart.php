<?php
class ProductTest extends WP_UnitTestCase {
    public function test_add_product_to_cart() {
        $product_id = 1;  // Sample product ID
        WC()->cart->add_to_cart($product_id);
        $this->assertTrue(WC()->cart->has_product($product_id));
    }
}
?>