<?php
declare(strict_types=1);

namespace Selenium\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class Esmc (ESET Security Management Center)
 *
 * @package Selenium\Command
 */
class Esmc extends Command
{
    /** @var string $defaultName command name */
    protected static $defaultName = 'esmc';

    private $service;

    /**
     * Esmc constructor.
     *
     * @param \Selenium\Service\Esmc $service
     */
    public function __construct(\Selenium\Service\Esmc $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * {@inheritDoc}
     */
    public function configure()
    {
        $this->setDescription('ESET Security Management Center Console.');
        $this->addArgument('type');
    }

    /**
     * {@inheritDoc}
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {

        ($this->service)();
        $output->writeln('ESET Security Management Center');
    }
}
