<?php
use App\Entity\User;
use App\Entity\Role;
use Doctrine\ORM\EntityManagerInterface;

require '/var/azuracast/www/vendor/autoload.php';

$_ENV['REDIS_HOST'] = '/run/redis/redis.sock';
$_ENV['REDIS_PORT'] = '0';

$app = App\AppFactory::createApp();
$di = $app->getContainer();

/** @var EntityManagerInterface $em */
$em = $di->get(EntityManagerInterface::class);

$email = 'admin@azuracast.com';
$password = 'Admin12345!';

$user = new User();
$user->email = $email;
$user->auth_password = $password;
$user->name = 'Radio Admin';

$superAdminRole = $em->find(Role::class, 1);
if ($superAdminRole) {
    $user->roles->add($superAdminRole);
}

$em->persist($user);
$em->flush();

echo "SUCCESS: Created admin account " . $user->email . PHP_EOL;
