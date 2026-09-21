<?php
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

$_ENV['REDIS_HOST'] = '127.0.0.1';
$_ENV['REDIS_PORT'] = '6379';

require '/var/azuracast/www/vendor/autoload.php';

$app = App\AppFactory::createApp();
$di = $app->getContainer();

/** @var EntityManagerInterface $em */
$em = $di->get(EntityManagerInterface::class);

$userRepo = $em->getRepository(User::class);
/** @var User|null $user */
$user = $userRepo->findOneBy(['email' => 'admin@azuracast.com']);

if ($user) {
    $user->setNewPassword('Admin12345!');
    $em->persist($user);
    $em->flush();
    echo "SUCCESS: Updated password for " . $user->email . PHP_EOL;
} else {
    echo "ERROR: User not found" . PHP_EOL;
}

// Mark setup complete
$settingsRepo = $di->get(App\Entity\Repository\SettingsRepository::class);
$settings = $settingsRepo->read();
$settings->setSetupCompleteTime(time());
$settingsRepo->write($settings);

echo "SETUP COMPLETE MARKED SUCCESSFUL" . PHP_EOL;
