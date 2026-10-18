<?php
$plugin=file_get_contents(__DIR__.'/../wp/wp-content/mu-plugins/craftpixel-storefront.php');
$checks=array(
 'shortcode'=>strpos($plugin,"add_shortcode('craftpixel_store'")!==false,
 'default checkout gate'=>strpos($plugin,"constant(self::GATE)===true")!==false,
 'gateway filter'=>strpos($plugin,'woocommerce_available_payment_gateways')!==false,
 'purchasing filter'=>strpos($plugin,'woocommerce_is_purchasable')!==false,
 'sanitized search'=>strpos($plugin,"sanitize_text_field(wp_unslash(\$_GET['cp_search']))")!==false,
 'escaped product name'=>strpos($plugin,'esc_html($product->get_name())')!==false,
 'no product seeding'=>strpos($plugin,'wp_insert_post')===false,
 'no destructive migration'=>strpos($plugin,'DROP TABLE')===false&&strpos($plugin,'TRUNCATE TABLE')===false
);
$failed=0;foreach($checks as $name=>$ok){echo ($ok?'PASS':'FAIL')." - ".$name.PHP_EOL;if(!$ok)$failed++;}exit($failed?1:0);
