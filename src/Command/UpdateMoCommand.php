<?php

declare(strict_types=1);

namespace Ruga\I18n\Command;

use Ruga\I18n\Iso639;
use Ruga\I18n\Localization;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateMoCommand extends Command
{
    private array $config;
    
    
    
    public function __construct(array $config, $name = null)
    {
        \Ruga\Log::functionHead();
        
        parent::__construct($name);
        $this->config = $config;
    }
    
    
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $files = [];
        foreach ($this->config[Localization::class][Localization::LANGUAGES] ?? [] as $language) {
            $a['mo'] = "{$this->config[Localization::class][Localization::GETTEXT_MO_DIR]}/{$language}.mo";
            $a['po'] = "{$this->config[Localization::class][Localization::GETTEXT_PO_DIR]}/{$language}.po";
            $files[$language] = $a;
        }
        
        
        foreach ($files as $language => $file) {
            // Do not compile mo file for the source language
            if ($language == ($this->config[Localization::class][Localization::GETTEXT_SRC_LANG] ?? '')) {
                $output->writeln("Skipping source language \"{$language}\"");
                $output->writeln("");
                continue;
            }
            
            $output->writeln("Compiling \"{$file['po']}\"");
            $output->writeln("       => \"{$file['mo']}\"");
            $cmd = "c:/bin/gettext/bin/msgfmt --use-fuzzy \"{$file['po']}\" --output-file=\"{$file['mo']}\"";
            
            exec($cmd);
            $output->writeln("");
        }
        
        
        return Command::SUCCESS;
    }
}