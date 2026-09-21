<?php
use App\Entity\User;
use App\Entity\Role;
use Doctrine\ORM\EntityManagerInterface;

putenv('ENABLE_REDIS=false');
$_ENV['ENABLE_REDIS'] = 'false';
$_SERVER['ENABLE_REDIS'] = 'false';

require '/var/azuracast/www/vendor/autoload.php';

$app = App\AppFactory::createApp();
$di = $app->getContainer();

/** @var EntityManagerInterface $em */
$em = $di->get(EntityManagerInterface::class);

$roleRepo = $di->get(App\Entity\Repository\RolePermissionRepository::class);
$role = $roleRepo->ensureSuperAdministratorRole();

$email = 'admin@azuracast.com';
$password = 'Admin12345!';

$user = new User();
$user->email = $email;
$user->setNewPassword($password);
$user->name = 'Administrator';
$user->roles->add($role);

$em->persist($user);
$em->flush();

echo "SUCCESS: Created user " . $user->email . PHP_EOL;
