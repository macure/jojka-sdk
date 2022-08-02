<?php

namespace Macure\JojkaSDK\Http\Options;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Add contact to group options
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class AddContactToGroupOptions
{
    /**
     * An existing contact's mobile number. 
     * 
     * Required.
     */
    public const MSISDN = 'msisdn';

    /**
     * Group name, which the stated contact will be a member of.
     * 
     * Required.
     */
    public const GROUP = 'group'; 

    /**
     * Configure options
     *
     * @param OptionsResolver $resolver
     *
     * @return void
     */
    public static function configure(OptionsResolver $resolver) 
    {
        $resolver
            ->setRequired([self::MSISDN, self::GROUP]);
    }
}
