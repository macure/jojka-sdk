<?php

namespace Macure\JojkaSDK\Http\Requests;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Remove contact request
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class RemoveContactRequest extends Request
{
    public const URI = parent::URI . '/rm_contact';
    
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
