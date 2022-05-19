<?php

declare(strict_types=1);

namespace Ruga\I18n\Command;

use Ruga\I18n\Localization;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdatePotCommand extends Command
{
    private array $config;
    
    
    
    public function __construct(array $config, $name = null)
    {
        parent::__construct($name);
        $this->config = $config;
    }
    
    
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $gettext_pot = $this->config[Localization::class][Localization::GETTEXT_POT] ?? 'messages.pot';
        $tmpfile = getcwd() . "/tmp/gettext_filelist.txt";
        
        $output->writeln("Creating file list");
        @unlink($tmpfile);
        touch($tmpfile);
        foreach ($this->config[Localization::class][Localization::GETTEXT_SRC_DIRS] ?? [] as $src) {
            exec("c:\\bin\\find \"{$src}\" -name *.php >>\"{$tmpfile}\"");
            exec("c:\\bin\\find \"{$src}\" -name *.phtml >>\"{$tmpfile}\"");
        }
        
        $output->writeln("Creating POT file \"{$gettext_pot}\"");
        $cmd = "c:/bin/gettext/bin/xgettext --no-wrap --files-from=\"{$tmpfile}\" --language=PHP --keyword=_ --keyword=__ --keyword=translate --from-code=\"UTF-8\" --add-location --output=\"{$gettext_pot}\"";
        exec($cmd);
        
        return Command::SUCCESS;
    }
    
    
}