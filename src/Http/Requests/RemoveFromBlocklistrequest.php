<?php

namespace Macure\JojkaSDK\Http\Requests;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Remove from blocklist options
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class RemoveFromBlocklistrequest extends Request
{
    public const URI = parent::URI . '/rm_from_blocklist';

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
