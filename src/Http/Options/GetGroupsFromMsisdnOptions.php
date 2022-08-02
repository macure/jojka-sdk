<?php

namespace Macure\JojkaSDK\Http\Options;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Get groups from msisdn options class
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class GetGroupsFromMsisdnOptions
{
    /**
     * Contact's mobile number.
     * 
     * Required.
     */
    public const MSISDN = 'msisdn';

    /**
     * Configure options
     *
     * @param OptionsResolver $resolver
     *
     * @return void
     */
    public static function configure(OptionsResolver $resolver) 
    {
        $resolver->setRequired(self::MSISDN);
    }
}
