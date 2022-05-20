<?php

/**
 * Translate the string to the current language using the TranslatorInterface instance.
 *
 * @param string $message
 *
 * @return string
 * @throws Exception
 */
function __(string $message): string
{
//    return $message;
    return \Ruga\I18n\Facade\Localization::getTranslator()->translate($message);
}
