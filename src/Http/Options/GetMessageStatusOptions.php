<?php

namespace Macure\JojkaSDK\Http\Options;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Get message status pptions class
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class GetMessageStatusOptions
{
    /**
     * The ID of the SMS whose status is requested.
     * 
     * Required.
     */
    public const MSG_ID = 'msg_id';

    /**
     * Configure options
     *
     * @param OptionsResolver $resolver
     *
     * @return void
     */
    public static function configure(OptionsResolver $resolver) 
    {
        $resolver->setRequired(self::MSG_ID);
    }
}
