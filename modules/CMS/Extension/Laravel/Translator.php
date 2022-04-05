<?php

/**
 * This file is part of the TwigBridge package.
 *
 * @copyright Robert Crowe <hello@vivalacrowe.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Juzaweb\CMS\Extension\Laravel;

use Illuminate\Contracts\Translation\Translator as LaravelTranslator;
use Twig\TwigFilter;
use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;

/**
 * Access Laravels translator class in your Twig templates.
 */
class Translator extends AbstractExtension
{
    /**
     * @var \Illuminate\Translation\Translator
     */
    protected $translator;

    /**
     * Create a new translator extension
     *
     * @param \Illuminate\Translation\Translator
     */
    public function __construct(LaravelTranslator $translator)
    {
        $this->translator = $translator;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'App_Extension_Laravel_Translator';
    }

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('trans', [$this->translator, 'get']),
            new TwigFunction('trans_choice', [$this->translator, 'choice']),
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function getFilters()
    {
        return [
            new TwigFilter(
                'trans',
                [$this->translator, 'get'],
                [
                    'pre_escape' => 'html',
                    'is_safe'    => ['html'],
                ]
            ),
            new TwigFilter(
                'trans_choice',
                [$this->translator, 'choice'],
                [
                    'pre_escape' => 'html',
                    'is_safe'    => ['html'],
                ]
            ),
        ];
    }
}
