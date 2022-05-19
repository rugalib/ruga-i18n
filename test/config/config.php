<?php

return [
    \Ruga\I18n\Localization::class => [
        \Ruga\I18n\Localization::LANGUAGES => ['deu', 'fra', 'ita'],
    ],
    'translator' => [
//        'locale' => 'deu',
        'translation_file_patterns' => [
            [
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../data/language/compiled',
                'pattern' => '%s.mo',
            ],
        ],
    ],
];
