<?php

namespace Macure\JojkaSDK\Http\Requests;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Add to blocklist request
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class AddToBlocklistRequest extends Request
{
    public const URI = parent::URI . '/add_to_blocklist';

    /**
     * Contact's mobile number.
     * 
     * Required.
     */
    public const MSISDN = 'msisdn';

    /**
     * {@inheritDoc}
     */
    protected function configure(OptionsResolver $resolver) 
    {
        parent::configure($resolver);
        
        $resolver->setRequired(self::MSISDN);
    }
}
