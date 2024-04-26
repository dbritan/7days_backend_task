<?php

namespace App\Command;

use Domain\Post\PostManager;
use joshtronic\LoremIpsum;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateSummaryPostCommand extends Command
{
    protected static $defaultName = 'app:generate-summary-post';
    protected static $defaultDescription = 'Run app:generate-summary-post';
    private PostManager $postManager;
    private LoremIpsum $loremIpsum;

    /**
     *
     * @param PostManager $postManager
     * @param LoremIpsum $loremIpsum
     * @param string|null $name
     */
    public function __construct(
        PostManager $postManager,
        LoremIpsum $loremIpsum,
        string $name = null
    ) {
        parent::__construct($name);
        $this->postManager = $postManager;
        $this->loremIpsum = $loremIpsum;
    }

    /**
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $title = \sprintf('Summary %s', \date('Y-m-d'));
        $content = $this->loremIpsum->paragraphs(1);

        $this->postManager->addPost($title, $content);

        $output->writeln('A summary post has been generated.');

        return Command::SUCCESS;
    }
}
