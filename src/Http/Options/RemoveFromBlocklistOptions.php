<?php

namespace Macure\JojkaSDK\Http\Options;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Remove from blocklist options
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class RemoveFromBlocklistOptions
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
