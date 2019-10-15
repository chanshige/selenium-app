<?php
namespace Selenium\Command;

use Selenium\Interfaces\AnalyzeMixedContentInterface;
use Selenium\Support\OutputStyle;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class SSLChecker
 *
 * @package Selenium\Command
 */
final class SSLChecker extends Command
{
    /** @var AnalyzeMixedContentInterface */
    private $service;

    /**
     * Checker constructor.
     *
     * @param AnalyzeMixedContentInterface $service
     */
    public function __construct(AnalyzeMixedContentInterface $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * {@inheritDoc}
     */
    public function configure()
    {
        $this->setName('sslchecker')
            ->setDescription('Always-On SSL Checker')
            ->setHelp('This command is... SSL Checker.');

        $this->addArgument('xml-url', InputArgument::REQUIRED);
    }

    /**
     * {@inheritDoc}
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('[SSL CHECK START]: --------------------------');
        /** @var object $data */
        $count = ($this->service)($input->getArgument('xml-url'), function ($data) use ($output) {
            if ($data()->isSSL) {
                $output->writeln(OutputStyle::info('[SSL:OK] [URL] ' . $data()->url));
                return;
            }

            $output->writeln(OutputStyle::error('[SSL:NG] [URL] ' . $data()->url));
            $output->writeln(OutputStyle::comment('[ERROR DETAIL] ' . var_export($data()->content, true)));
        });

        $output->writeln('[TOTAL]: ' . $count);
        $output->writeln('[SSL CHECK END]: ----------------------------');
    }
}
