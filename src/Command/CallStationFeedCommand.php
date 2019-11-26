<?php

namespace App\Command;

use App\Entity\StationFeed;
use App\Service\ASQICNAPI;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CallStationFeedCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:csf';

    private $stations = [5722, 1437];

    private $ASQICN;

    private $em;

    public function __construct(ContainerInterface $container)
    {
        $this->ASQICN = new ASQICNAPI();
        $this->em = $container->get('doctrine')->getManager();
        parent::__construct();
    }

    protected function configure()
    {
        $this
            // the short description shown while running "php bin/console list"
            ->setDescription('Complete history for station feed (cron).')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command call station feed function and save station feed in db...');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        foreach ($this->stations as $station) {
            $feed = $this->ASQICN->getStationFeed((string) $station);
            $stationFeed = new StationFeed();
            $stationFeed->setIdx((int) $feed['idx'])
                ->setData(json_encode($feed['iaqi']))
                ->setDate(new \DateTime($feed['time']['s']));
            $this->em->persist($stationFeed);
        }

        $this->em->flush();
    }
}
