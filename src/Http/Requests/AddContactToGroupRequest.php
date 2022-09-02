<?php

namespace Macure\JojkaSDK\Http\Requests;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Add contact to group request
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class AddContactToGroupRequest extends Request 
{
    public const URI = parent::URI . '/add_contact_to_group';

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
     * {@inheritDoc}
     */
    protected function configure(OptionsResolver $resolver) 
    {
        parent::configure($resolver);
        
        $resolver
            ->setRequired([self::MSISDN, self::GROUP]);
    }
}
