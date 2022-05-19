<?php

declare(strict_types=1);

namespace Ruga\I18n\Test;

use Laminas\I18n\Translator\Translator;
use Laminas\I18n\Translator\TranslatorInterface;
use Ruga\I18n\Localization;
use Ruga\I18n\LocalizationInterface;

/**
 * @author                 Roland Rusch, easy-smart solution GmbH <roland.rusch@easy-smart.ch>
 */
class TranslatorTest extends \Ruga\I18n\Test\PHPUnit\AbstractTestSetUp
{
    public function testCanCreateLocalization(): void
    {
        /** @var Localization $loc */
        $loc = $this->getContainer()->get(LocalizationInterface::class);
        $this->assertInstanceOf(Localization::class, $loc);
        $loc->setLanguage('deu');
        $lang = $loc->getLanguage();
        $this->assertEquals('deu', $lang);
    }
    
    
    
    public function testCanCreateTranslator(): void
    {
        $t = $this->getContainer()->get(TranslatorInterface::class);
        $this->assertInstanceOf(Translator::class, $t);
        $s = $t->translate('Fahrzeug');
        echo $s . PHP_EOL;
        $this->assertEquals('Fahrzeug', $s);
        
        $s = $t->translate('Fahrzeug', 'default', 'ita');
        echo $s . PHP_EOL;
        $this->assertEquals('Veicolo', $s);
    }
    
    
    
    public function testCanCreatePluralTranslator(): void
    {
        $t = $this->getContainer()->get(TranslatorInterface::class);
        $this->assertInstanceOf(Translator::class, $t);
        $s = $t->translatePlural('Fahrzeug', 'Fahrzeuge', 0);
        echo $s . PHP_EOL;
        $this->assertEquals('Fahrzeuge', $s);
        
        $s = $t->translatePlural('Fahrzeug', 'Fahrzeuge', 1);
        echo $s . PHP_EOL;
        $this->assertEquals('Fahrzeug', $s);
        
        $s = $t->translatePlural('Fahrzeug', 'Fahrzeuge', 2);
        echo $s . PHP_EOL;
        $this->assertEquals('Fahrzeuge', $s);
        
        
        $s = $t->translatePlural('Fahrzeug', 'Fahrzeuge', 0, 'default', 'fra');
        echo $s . PHP_EOL;
        $this->assertEquals("véhicule", $s);
        
        $s = $t->translatePlural('Fahrzeug', 'Fahrzeuge', 1, 'default', 'fra');
        echo $s . PHP_EOL;
        $this->assertEquals("véhicule", $s);
        
        $s = $t->translatePlural('Fahrzeug', 'Fahrzeuge', 2, 'default', 'fra');
        echo $s . PHP_EOL;
        $this->assertEquals("véhicules", $s);
    }
    
    
}
