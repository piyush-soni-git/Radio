<?php
$css = file_get_contents('/tmp/custom_theme.css');

use Doctrine\ORM\EntityManagerInterface;

require '/var/azuracast/www/vendor/autoload.php';

$_ENV['REDIS_HOST'] = '/run/redis/redis.sock';
$_ENV['REDIS_PORT'] = '0';

$app = App\AppFactory::createApp();
$di = $app->getContainer();

/** @var EntityManagerInterface $em */
$em = $di->get(EntityManagerInterface::class);

$conn = $em->getConnection();
$conn->executeStatement('UPDATE settings SET public_custom_css = ?, internal_custom_css = ?', [$css, $css]);

echo "SUCCESS: Applied Custom CSS to public_custom_css and internal_custom_css in AzuraCast settings!\n";
