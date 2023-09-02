<?php
/*
 * SPDX-FileCopyrightText: 2023 Roland Rusch, easy-smart solution GmbH <roland.rusch@easy-smart.ch>
 * SPDX-License-Identifier: AGPL-3.0-only
 */

declare(strict_types=1);

namespace Ruga\I18n\Command;

use Ruga\I18n\Iso639;
use Ruga\I18n\Localization;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdatePoCommand extends Command
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
        $gettext_pot = realpath($this->config[Localization::class][Localization::GETTEXT_POT] ?? 'messages.pot');
        
        $files = [];
        foreach ($this->config[Localization::class][Localization::LANGUAGES] ?? [] as $language) {
            $a['mo'] = "{$this->config[Localization::class][Localization::GETTEXT_MO_DIR]}/{$language}.mo";
            $a['po'] = "{$this->config[Localization::class][Localization::GETTEXT_PO_DIR]}/{$language}.po";
            $files[$language] = $a;
        }
        
        
        foreach ($files as $language => $file) {
            // Do not create po file for the source language
            if ($language == ($this->config[Localization::class][Localization::GETTEXT_SRC_LANG] ?? '')) {
                $output->writeln("Skipping source language \"{$language}\"");
                $output->writeln("");
                continue;
            }
            
            $language2 = (new \Ruga\I18n\Iso639())->find($language, Iso639\Key::ALPHA_2);
            $locale = "{$language2}_" . strtoupper($language2);
            if (file_exists($file['po'])) {
                $output->writeln("Updating \"{$file['po']}\"");
                $cmd = "c:/bin/gettext/bin/msgmerge --no-wrap --backup=no --update \"{$file['po']}\" \"{$gettext_pot}\"";
            } else {
                $output->writeln("Initializing \"{$file['po']}\"");
                $cmd = "c:/bin/gettext/bin/msginit --no-wrap --locale={$language2} --input=\"{$gettext_pot}\" --output-file=\"{$file['po']}\"";
            }
            
            exec($cmd);
            $output->writeln("");
        }
        
        
        return Command::SUCCESS;
    }
    
    
}