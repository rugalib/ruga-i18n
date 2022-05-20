<?php

declare(strict_types=1);

namespace Ruga\I18n\Test;

use Laminas\I18n\Translator\Translator;
use Laminas\I18n\Translator\TranslatorInterface;
use Ruga\I18n\Localization;
use Ruga\I18n\LocalizationInterface;
use Ruga\Std\Facade\AbstractFacade;

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
        echo "{$s}" . PHP_EOL;
        $this->assertEquals('veicolo', $s);
    }
    
    
    
    public function testCanCreatePluralTranslator(): void
    {
        $t = $this->getContainer()->get(TranslatorInterface::class);
        $this->assertInstanceOf(Translator::class, $t);
        $s = $t->translatePlural('%s Fahrzeug', '%s Fahrzeuge', 0);
        $s = sprintf($s, 0);
        echo $s . PHP_EOL;
        $this->assertEquals('0 Fahrzeuge', $s);
        
        $s = $t->translatePlural('%s Fahrzeug', '%s Fahrzeuge', 1);
        $s = sprintf($s, 1);
        echo $s . PHP_EOL;
        $this->assertEquals('1 Fahrzeug', $s);
        
        $s = $t->translatePlural('%s Fahrzeug', '%s Fahrzeuge', 2);
        $s = sprintf($s, 2);
        echo $s . PHP_EOL;
        $this->assertEquals('2 Fahrzeuge', $s);
        
        
        $s = $t->translatePlural('%s Fahrzeug', '%s Fahrzeuge', 0, 'default', 'fra');
        $s = sprintf($s, 0);
        echo $s . PHP_EOL;
        $this->assertEquals("0 véhicule", $s);
        
        $s = $t->translatePlural('%s Fahrzeug', '%s Fahrzeuge', 1, 'default', 'fra');
        $s = sprintf($s, 1);
        echo $s . PHP_EOL;
        $this->assertEquals("1 véhicule", $s);
        
        $s = $t->translatePlural('%s Fahrzeug', '%s Fahrzeuge', 2, 'default', 'fra');
        $s = sprintf($s, 2);
        echo $s . PHP_EOL;
        $this->assertEquals("2 véhicules", $s);
    }
    
    
    
    public function testCanTransleWithGlobalShort(): void
    {
        AbstractFacade::setController($this->getContainer());
        $t = $this->getContainer()->get(TranslatorInterface::class);
        $this->assertInstanceOf(Translator::class, $t);
        
        echo ($s = __('Fahrzeug')) . PHP_EOL;
        $this->assertEquals('Fahrzeug', $s);
        
        $t->setLocale('ita');
        echo ($s = __('Fahrzeug')) . PHP_EOL;
        $this->assertEquals('veicolo', $s);
    }
    
}
