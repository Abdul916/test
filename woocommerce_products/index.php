<?php
$consumer_key = 'ck_ac2943bcfa7354f777970ffe6ba273d97aac172b';
$consumer_secret = 'cs_e4fdcc72fdb70d3fdb532576fd31589ae18fef9e';
$store_url = 'https://explorelogicsit.net/wctest/wp-json/wc/v3/products';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $store_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERPWD, $consumer_key . ":" . $consumer_secret);
$response = curl_exec($ch);
if (curl_errno($ch)) {
	echo 'Error:' . curl_error($ch);
} else {
	$products = json_decode($response, true);
	echo "<pre>";
	print_r($products);
	echo "</pre>";
	// if (!empty($products)) {
	// 	foreach ($products as $product) {
	// 		echo "Product Name: " . $product['name'] . "<br>";
	// 		echo "Price: " . $product['price'] . "<br>";
	// 		echo "Stock Status: " . $product['stock_status'] . "<br><br>";
	// 	}
	// } else {
	// 	echo "No products found.";
	// }
}
curl_close($ch);
?>