<?php

declare(strict_types=1);

namespace Ruga\I18n;

use Laminas\I18n\Translator\Translator;
use Locale;
use Mezzio\Session\SessionInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Ruga\I18n\Container\LocalizationMiddlewareFactory;

/**
 * Class LocalizationMiddleware
 *
 * @see      LocalizationMiddlewareFactory
 * @author   Roland Rusch, easy-smart solution GmbH <roland.rusch@easy-smart.ch>
 */
class LocalizationMiddleware implements MiddlewareInterface
{
    private array $config;
    
    private ?LocalizationInterface $localization = null;
    
    private ?Translator $translator = null;
    
    
    
    /**
     * Construct LocalizationMiddleware. $config must be provided by the factory.
     *
     * @param array $config
     *
     * @see LocalizationMiddlewareFactory
     *
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }
    
    
    
    /**
     * Set the Localization object. It is used as a store for language and locale information. App and Helpers can get
     * an instance of the Localization object from container.
     *
     * @param LocalizationInterface $localization
     */
    public function setLocalization(LocalizationInterface $localization)
    {
        $this->localization = $localization;
    }
    
    
    
    /**
     * Set the translator.
     *
     * @param Translator $translator
     */
    public function setTranslator(Translator $translator)
    {
        $this->translator = $translator;
    }
    
    
    
    /**
     * Process an incoming server request.
     *
     * Processes an incoming server request in order to produce a response.
     * If unable to produce the response itself, it may delegate to the provided
     * request handler to do so.
     *
     * @param ServerRequestInterface  $request
     * @param RequestHandlerInterface $handler
     *
     * @return ResponseInterface
     * @throws \Exception
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        \Ruga\Log::functionHead($this);
        
        // Hardcoded defaults if config is not available
        $localeDefault = $this->config[Localization::LOCALE_DEFAULT] ?? 'de_CH';
        $localeAttrName = $this->config[Localization::LOCALE_ATTRIBUTE_NAME] ?? 'locale';
        $langDefault = $this->config[Localization::LANGUAGE_DEFAULT] ?? 'deu';
        $langAttrName = $this->config[Localization::LANGUAGE_ATTRIBUTE_NAME] ?? 'language';
        
        /** @var SessionInterface $session */
        $session = $request->getAttribute('session', null);
        
        
        // Get the locale from the session, if available
        if ($session && $session->has($localeAttrName)) {
            $locale = $session->get($localeAttrName);
        } else {
            // Get locale from request, fallback to the user's browser preference
            $locale = $request->getAttribute(
                $localeAttrName,
                Locale::acceptFromHttp(
                    $request->getServerParams()['HTTP_ACCEPT_LANGUAGE'] ?? $localeDefault
                ) ?? $localeDefault
            );
        }
        // Get locale from query string
        // This overrides all previous attempts to find a locale
        $locale = $request->getQueryParams()[$localeAttrName] ?? $locale;
        
        
        // Get the language from the session, if available
        if ($session && $session->has($langAttrName)) {
            $language = $session->get($langAttrName);
        } else {
            // Get language from request, fallback to the current locale
            $language = $request->getAttribute($langAttrName, Locale::getPrimaryLanguage($locale));
        }
        // Get language from query string
        // This overrides all previous attempts to find a locale
        $language = $request->getQueryParams()[$langAttrName] ?? $language ?? $langDefault;
        
        // Check language against the data from Iso639 (and normalize to 3-letter-code)
        $language = (new \Ruga\I18n\Iso639())->find($language, Iso639\Key::DEFAULT, $langDefault);
        
        
        // Store the locale and language to the LocalizationInterface
        if ($this->localization) {
            $this->localization->setLanguage($language);
            $this->localization->setLocale($locale);
        }
        
        // Set the language in translator
        if ($this->translator) {
            $this->translator->setFallbackLocale($langDefault);
            $this->translator->setLocale($language);
        }
        
        
        // Store the locale and language to the session
        if ($session) {
            $session->set($localeAttrName, $locale);
            $session->set($langAttrName, $language);
        }
        
        // Store the locale and language as a request attribute
        $request = $request->withAttribute($localeAttrName, $locale)->withAttribute($langAttrName, $language);
        
        // Set the default locale
        Locale::setDefault($locale);
        
        // Delegate to the next middleware
        return $handler->handle($request);
    }
}