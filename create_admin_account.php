<?php
use App\Entity\User;
use App\Entity\Role;
use Doctrine\ORM\EntityManagerInterface;

$_ENV['REDIS_HOST'] = '127.0.0.1';
$_ENV['REDIS_PORT'] = '6379';

require '/var/azuracast/www/vendor/autoload.php';

// Bootstrap App Container
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
$user->name = 'Radio Admin';
$user->roles->add($role);

$em->persist($user);
$em->flush();

// Mark setup complete
$settingsRepo = $di->get(App\Entity\Repository\SettingsRepository::class);
$settings = $settingsRepo->read();
$settings->setSetupCompleteTime(time());
$settingsRepo->write($settings);

echo "SUCCESS: Created Administrator account: " . $email . PHP_EOL;
