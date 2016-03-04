<?php

namespace LasseHaslev\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class MailFetcher
 * @author Lasse S. Haslev
 */
class MailFetcher extends Command
{

    protected $input;
    protected $output;

    /**
     * Configure the Command
     *
     * @return void
     */
    protected function configure()
    {
        $this->setName( 'mail_fetch' )
            ->setDescription( 'Fetches the mails from the google mail api' )
            ->addArgument( 'file', InputArgument::REQUIRED, 'Get the .json file with all the mail containing the information of the invoice senders.' )

            ->addOption( 'email', null, InputOption::VALUE_OPTIONAL, 'Force the email input.' )
            ->addOption( 'api-key', null, InputOption::VALUE_OPTIONAL, 'Force the api key.' );
    }

    /**
     * Do the execution
     *
     * @return void
     */
    protected function execute( InputInterface $input, OutputInterface $output )
    {

        $this->input = $input;
        $this->output = $output;

        $fileContent = $this->getFileContent( $this->getFullFilepath() );

        $output->writeln( print_r( $fileContent ) );

    }

    /**
     * Get the filepath to the information file
     *
     * @return String
     */
    protected function getFullFilepath()
    {
        // Get the file containing the information of the invoice senders
        $relativeFilePath = $this->input->getArgument( 'file' );

        // Get the filename
        $filename = basename( $relativeFilePath );

        // Get the directory we run from
        $runningDirectory = getcwd() . '/';
        // $output->writeln( $runningDirectory );

        // Create a real path
        $realPath = $runningDirectory . $relativeFilePath;
        $realPath = realpath( $realPath );
        return $realPath;
    }

    /**
     * Get the content and parse the content of the data file
     *
     * @return Array
     */
    protected function getFileContent( $filePath )
    {
        $fileContent = file_get_contents( $filePath );
        return json_decode( $fileContent, true );
    }


}
