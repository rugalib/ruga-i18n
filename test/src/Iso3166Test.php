<?php
/*
 * SPDX-FileCopyrightText: 2023 Roland Rusch, easy-smart solution GmbH <roland.rusch@easy-smart.ch>
 * SPDX-License-Identifier: AGPL-3.0-only
 */

declare(strict_types=1);

namespace Ruga\I18n\Test;

use Ruga\I18n\Iso3166\Key;
use Ruga\I18n\Iso3166\Name;

/**
 * @author                 Roland Rusch, easy-smart solution GmbH <roland.rusch@easy-smart.ch>
 */
class Iso3166Test extends \Ruga\I18n\Test\PHPUnit\AbstractTestSetUp
{
    public function testCanCreateIso3166Object(): void
    {
        $iso3166 = new \Ruga\I18n\Iso3166(
            (new \Ruga\I18n\Iso639\Filter\All())->then(new \Ruga\I18n\Iso3166\Filter\CentralEurope())
        );
        
        $this->assertInstanceOf(\Ruga\I18n\Iso3166::class, $iso3166);
    }
    
    
    
    public function testCanGetMultiOptions(): void
    {
        $iso3166 = new \Ruga\I18n\Iso3166(new \Ruga\I18n\Iso3166\Filter\CentralEurope());
        $this->assertInstanceOf(\Ruga\I18n\Iso3166::class, $iso3166);
        
        $multioptions = $iso3166->getMultiOptions();
        var_dump($multioptions);
        $this->assertIsArray($multioptions);
        $this->assertEquals('Spanien', $multioptions['ESP']);
    }
    
    
    public function testCanGetMultiOptionsA2(): void
    {
        $iso3166 = new \Ruga\I18n\Iso3166((new \Ruga\I18n\Iso3166\Filter\CentralEurope())->then(new \Ruga\I18n\Iso3166\Filter\ChangeKey(Key::ALPHA_2)));
        $this->assertInstanceOf(\Ruga\I18n\Iso3166::class, $iso3166);
        
        $multioptions = $iso3166->getMultiOptions();
        var_dump($multioptions);
        $this->assertIsArray($multioptions);
        $this->assertEquals('Spanien', $multioptions['ES']);
    }
    
    
    
    
    public function testCanGetString(): void
    {
        $iso3166 = new \Ruga\I18n\Iso3166(new \Ruga\I18n\Iso3166\Filter\CentralEurope());
        $this->assertInstanceOf(\Ruga\I18n\Iso3166::class, $iso3166);
        
        $this->assertEquals("Deutschland", $iso3166->getString('DEU', Name::DEU));
    }
    
    
    
    public function testCanGetStringInFrench(): void
    {
        $iso3166 = new \Ruga\I18n\Iso3166(new \Ruga\I18n\Iso3166\Filter\CentralEurope());
        $this->assertInstanceOf(\Ruga\I18n\Iso3166::class, $iso3166);
        
        $this->assertEquals("Allemagne", $iso3166->getString('DEU', Name::FRA));
    }
    
    
    
    public function testCanGetData(): void
    {
        $iso3166 = new \Ruga\I18n\Iso3166(new \Ruga\I18n\Iso3166\Filter\CentralEurope());
        $this->assertInstanceOf(\Ruga\I18n\Iso3166::class, $iso3166);
        
        $a = $iso3166->getData('ITA');
        var_dump($a);
        $this->assertIsArray($a);
        $this->assertCount(18, $a);
        $this->assertEquals('IT', $a[Key::ALPHA_2]);
        $this->assertEquals('ITA', $a[Key::ALPHA_3]);
        $this->assertEquals('Italien', $a[Key::NAME_deu]);
        $this->assertEquals('Italie', $a[Key::NAME_fra]);
        $this->assertEquals('Italy', $a[Key::NAME_eng]);
        $this->assertEquals('EUR', $a[Key::CURRENCY_CODE]);
    }
    
    
    
    public function testCanIterate(): void
    {
        $iso3166 = new \Ruga\I18n\Iso3166(new \Ruga\I18n\Iso3166\Filter\CentralEurope());
        $this->assertInstanceOf(\Ruga\I18n\Iso3166::class, $iso3166);
        
        foreach ($iso3166 as $key => $val) {
            echo "{$key} => " . print_r($val, true);
            echo PHP_EOL;
        }
    }
    
    
    
    public function testCanUseArrayKey(): void
    {
        $iso3166 = new \Ruga\I18n\Iso3166(new \Ruga\I18n\Iso3166\Filter\CentralEurope());
        $this->assertInstanceOf(\Ruga\I18n\Iso3166::class, $iso3166);
        
        $a = $iso3166['FRA'];
        var_dump($a);
        $this->assertIsArray($a);
        $this->assertCount(18, $a);
        $this->assertEquals('FR', $a[Key::ALPHA_2]);
        $this->assertEquals('FRA', $a[Key::ALPHA_3]);
        $this->assertEquals('Frankreich', $a[Key::NAME_deu]);
        $this->assertEquals('France', $a[Key::NAME_fra]);
        $this->assertEquals('France', $a[Key::NAME_eng]);
        $this->assertEquals('EUR', $a[Key::CURRENCY_CODE]);
    }
    
}
