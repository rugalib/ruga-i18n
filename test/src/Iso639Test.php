<?php
/*
 * SPDX-FileCopyrightText: 2023 Roland Rusch, easy-smart solution GmbH <roland.rusch@easy-smart.ch>
 * SPDX-License-Identifier: AGPL-3.0-only
 */

declare(strict_types=1);

namespace Ruga\I18n\Test;

use Ruga\I18n\Iso639\Key;
use Ruga\I18n\Iso639\Name;

/**
 * @author                 Roland Rusch, easy-smart solution GmbH <roland.rusch@easy-smart.ch>
 */
class Iso639Test extends \Ruga\I18n\Test\PHPUnit\AbstractTestSetUp
{
    public function testCanCreateIso639Object(): void
    {
        $iso639 = new \Ruga\I18n\Iso639(
            (new \Ruga\I18n\Iso639\Filter\All())
//        ->then(new \Ruga\I18n\Iso639\Filter\ChangeKey(\Ruga\I18n\Iso639\Key::ALPHA_2))
                ->then(new \Ruga\I18n\Iso639\Filter\CentralEurope())
//        ->then(new \Ruga\I18n\Iso639\Filter\Custom(['fra', 'ita'], \Ruga\I18n\Iso639\Key::ALPHA_3))
        );
        
        
        $this->assertInstanceOf(\Ruga\I18n\Iso639::class, $iso639);
    }
    
    
    
    public function testCanGetMultiOptions(): void
    {
        $iso639 = new \Ruga\I18n\Iso639(new \Ruga\I18n\Iso639\Filter\CentralEurope());
        $this->assertInstanceOf(\Ruga\I18n\Iso639::class, $iso639);
        
        $multioptions = $iso639->getMultiOptions();
        var_dump($multioptions);
        $this->assertIsArray($multioptions);
        $this->assertEquals('Spanisch', $multioptions['spa']);
    }
    
    
    
    public function testCanGetString(): void
    {
        $iso639 = new \Ruga\I18n\Iso639(new \Ruga\I18n\Iso639\Filter\CentralEurope());
        $this->assertInstanceOf(\Ruga\I18n\Iso639::class, $iso639);
        
        $this->assertEquals("Deutsch", $iso639->getString('deu', Name::DEU));
    }
    
    
    
    public function testCanGetStringInFrench(): void
    {
        $iso639 = new \Ruga\I18n\Iso639(new \Ruga\I18n\Iso639\Filter\CentralEurope());
        $this->assertInstanceOf(\Ruga\I18n\Iso639::class, $iso639);
        
        $this->assertEquals("allemand", $iso639->getString('deu', Name::FRA));
    }
    
    
    
    public function testCanGetData(): void
    {
        $iso639 = new \Ruga\I18n\Iso639(new \Ruga\I18n\Iso639\Filter\CentralEurope());
        $this->assertInstanceOf(\Ruga\I18n\Iso639::class, $iso639);
        
        $a = $iso639->getData('ita');
        var_dump($a);
        $this->assertIsArray($a);
        $this->assertCount(6, $a);
        $this->assertEquals('it', $a[Key::ALPHA_2]);
        $this->assertEquals('ita', $a[Key::ALPHA_3]);
        $this->assertEquals('Italienisch', $a[Key::NAME_deu]);
        $this->assertEquals('italien', $a[Key::NAME_fra]);
        $this->assertEquals('Italian', $a[Key::NAME_eng]);
        $this->assertEquals('I', $a[Key::ONELETTER]);
    }
    
    
    
    public function testCanIterate(): void
    {
        $iso639 = new \Ruga\I18n\Iso639(new \Ruga\I18n\Iso639\Filter\CentralEurope());
        $this->assertInstanceOf(\Ruga\I18n\Iso639::class, $iso639);
        
        foreach ($iso639 as $key => $val) {
            echo "{$key} => " . print_r($val, true);
            echo PHP_EOL;
        }
    }
    
    
    
    public function testCanUseArrayKey(): void
    {
        $iso639 = new \Ruga\I18n\Iso639(new \Ruga\I18n\Iso639\Filter\CentralEurope());
        $this->assertInstanceOf(\Ruga\I18n\Iso639::class, $iso639);
        
        $a = $iso639['fra'];
        var_dump($a);
        $this->assertIsArray($a);
        $this->assertCount(7, $a);
        $this->assertEquals('fr', $a[Key::ALPHA_2]);
        $this->assertEquals('fra', $a[Key::ALPHA_3]);
        $this->assertEquals('Französisch', $a[Key::NAME_deu]);
        $this->assertEquals('français', $a[Key::NAME_fra]);
        $this->assertEquals('French', $a[Key::NAME_eng]);
        $this->assertEquals('F', $a[Key::ONELETTER]);
    }
    
}
