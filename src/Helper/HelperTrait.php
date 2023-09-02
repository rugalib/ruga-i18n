<?php
/*
 * SPDX-FileCopyrightText: 2023 Roland Rusch, easy-smart solution GmbH <roland.rusch@easy-smart.ch>
 * SPDX-License-Identifier: AGPL-3.0-only
 */

declare(strict_types=1);

namespace Ruga\I18n\Helper;

/**
 * Helper trait for auto-completion of code in modern IDEs.
 *
 * The trait provides convenience methods for view helpers,
 * defined by the laminas-i18n component. It is designed to be used
 * for type-hinting $this variable inside laminas-view templates via doc blocks.
 *
 * The base class is PhpRenderer, followed by the helper trait from
 * the this component. However, multiple helper traits from different
 * components can be chained afterwards.
 *
 * @example @var \Laminas\View\Renderer\PhpRenderer|\Ruga\I18n\Helper\HelperTrait $this
 * @author Roland Rusch, easy-smart solution GmbH <roland.rusch@easy-smart.ch>
 *
 * @method LocalizationViewHelper localization()
 */
trait HelperTrait
{
}
