<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-10-03 14:07:56 --> Severity: 8192 --> strpos(): Non-string needles will be interpreted as strings in the future. Use an explicit chr() call to preserve the current behavior C:\xampp\htdocs\e2also\application\third_party\MX\Router.php 239
ERROR - 2024-10-03 14:07:56 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\e2also\application\modules\admin\models\Home_admin_model.php 130
ERROR - 2024-10-03 14:07:56 --> Severity: 8192 --> __autoload() is deprecated, use spl_autoload_register() instead C:\xampp\htdocs\e2also\application\libraries\PHPMailer\PHPMailerAutoload.php 46
ERROR - 2024-10-03 14:07:56 --> Query error: Table 'shop.vendors' doesn't exist - Invalid query: SELECT `vendors`.`url` as `vendor_url`, `products`.`id`, `products`.`quantity`, `products`.`image`, `products`.`url`, `products_translations`.`price`, `products_translations`.`title`, `products_translations`.`old_price`
FROM `products`
LEFT JOIN `products_translations` ON `products_translations`.`for_id` = `products`.`id`
LEFT JOIN `vendors` ON `vendors`.`id` = `products`.`vendor_id`
WHERE `products_translations`.`abbr` = 'en'
AND `visibility` = 1
AND `quantity` > 0
ORDER BY `products`.`procurement` DESC
 LIMIT 5
ERROR - 2024-10-03 14:07:56 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\e2also\system\core\Exceptions.php:271) C:\xampp\htdocs\e2also\system\core\Common.php 570
ERROR - 2024-10-03 14:08:44 --> Severity: 8192 --> strpos(): Non-string needles will be interpreted as strings in the future. Use an explicit chr() call to preserve the current behavior C:\xampp\htdocs\e2also\application\third_party\MX\Router.php 239
ERROR - 2024-10-03 14:08:44 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\e2also\application\modules\admin\models\Home_admin_model.php 130
ERROR - 2024-10-03 14:08:44 --> Severity: 8192 --> __autoload() is deprecated, use spl_autoload_register() instead C:\xampp\htdocs\e2also\application\libraries\PHPMailer\PHPMailerAutoload.php 46
ERROR - 2024-10-03 14:08:44 --> Query error: Table 'shop.vendors' doesn't exist - Invalid query: SELECT `vendors`.`url` as `vendor_url`, `products`.`id`, `products`.`quantity`, `products`.`image`, `products`.`url`, `products_translations`.`price`, `products_translations`.`title`, `products_translations`.`old_price`
FROM `products`
LEFT JOIN `products_translations` ON `products_translations`.`for_id` = `products`.`id`
LEFT JOIN `vendors` ON `vendors`.`id` = `products`.`vendor_id`
WHERE `products_translations`.`abbr` = 'en'
AND `visibility` = 1
AND `quantity` > 0
ORDER BY `products`.`procurement` DESC
 LIMIT 5
ERROR - 2024-10-03 14:08:44 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\e2also\system\core\Exceptions.php:271) C:\xampp\htdocs\e2also\system\core\Common.php 570
