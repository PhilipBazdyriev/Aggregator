<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\ContentParsing\Shikimori\Shikimori;
use Doctrine\Persistence\ManagerRegistry;

class ShikimoriContentCommand extends Command
{
    protected static $defaultName = 'shikimori:content';
    protected static $defaultDescription = 'Load contents from Shikimori';

    private $registry;

    public function __construct(ManagerRegistry $registry)
    {
        $this->registry = $registry;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $shikimori = new Shikimori($this->registry);
        $result = $shikimori->loadContent(1);
        $io->info('Pages scanned: ' . count($result));

        return Command::SUCCESS;
    }
}
