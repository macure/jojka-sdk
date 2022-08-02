<?php

namespace Macure\JojkaSDK\Http\Requests;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * In blocklist request
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class InBlocklistRequest extends Request
{
    public const URI = parent::URI . '/check_if_in_blocklist';

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
