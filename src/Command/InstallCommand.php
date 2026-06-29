<?php

namespace TonVendor\SymfonyBundlePack\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;

#[AsCommand(
    name: 'bundle-pack:install',
    description: 'Installe les fichiers de configuration et les entités de base dans le projet.',
)]
class InstallCommand extends Command
{
    private string $bundleRoot;
    private string $projectRoot;

    public function __construct(string $projectDir)
    {
        parent::__construct();
        $this->bundleRoot = dirname(__DIR__, 2);
        $this->projectRoot = $projectDir;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $fs = new Filesystem();

        $io->title('Installation de Symfony Bundle Pack');

        $copies = [
            // [source dans le bundle, destination dans le projet]
            ['resources/config/liip_imagine.yaml',              'config/packages/liip_imagine.yaml'],
            ['resources/config/vich_uploader.yaml',             'config/packages/vich_uploader.yaml'],
            ['resources/config/stof_doctrine_extensions.yaml',  'config/packages/stof_doctrine_extensions.yaml'],
            ['resources/config/doctrine.yaml',                  'config/packages/doctrine.yaml'],
            ['resources/config/security.yaml',                  'config/packages/security.yaml'],
            ['resources/config/routes.yaml',                    'config/routes.yaml'],
            ['resources/Entity/User.php',                       'src/Entity/User.php'],
            ['resources/Entity/Product.php',                    'src/Entity/Product.php'],
            ['resources/Security/AppAuthenticator.php',         'src/Security/AppAuthenticator.php'],
            ['resources/DataFixtures/UserFixtures.php',         'src/DataFixtures/UserFixtures.php'],
            ['resources/DataFixtures/ProductFixtures.php',      'src/DataFixtures/ProductFixtures.php'],
            ['resources/Controller/Admin/DashboardController.php',  'src/Controller/Admin/DashboardController.php'],
            ['resources/Controller/Admin/ProductCrudController.php', 'src/Controller/Admin/ProductCrudController.php'],
            ['resources/Controller/Admin/UserCrudController.php',    'src/Controller/Admin/UserCrudController.php'],
        ];

        foreach ($copies as [$src, $dest]) {
            $srcPath  = $this->bundleRoot . '/' . $src;
            $destPath = $this->projectRoot . '/' . $dest;

            if (!file_exists($srcPath)) {
                $io->warning("Fichier source introuvable : $src");
                continue;
            }

            if ($fs->exists($destPath)) {
                $io->comment("Ignoré (déjà présent) : $dest");
                continue;
            }

            $fs->copy($srcPath, $destPath);
            $io->text("<info>✔</info> Copié : $dest");
        }

        $io->success([
            'Installation terminée !',
            'Prochaines étapes :',
            '  1. php bin/console doctrine:migrations:diff',
            '  2. php bin/console doctrine:migrations:migrate',
            '  3. php bin/console doctrine:fixtures:load',
        ]);

        return Command::SUCCESS;
    }
}
