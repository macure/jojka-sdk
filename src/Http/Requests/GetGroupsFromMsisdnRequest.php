<?php

namespace Macure\JojkaSDK\Http\Requests;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Get groups from msisdn request class
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class GetGroupsFromMsisdnRequest extends Request
{
    public const URI = parent::URI . '/get_groups_from_msisdn';
    
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
