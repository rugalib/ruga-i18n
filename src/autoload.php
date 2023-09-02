<?php
/*
 * SPDX-FileCopyrightText: 2023 Roland Rusch, easy-smart solution GmbH <roland.rusch@easy-smart.ch>
 * SPDX-License-Identifier: AGPL-3.0-only
 */

declare(strict_types=1);

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
