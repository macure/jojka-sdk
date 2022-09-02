<?php

namespace Macure\JojkaSDK\Http\Requests;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Remove contact from group request
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class RemoveContactFromGroupRequest extends Request
{
    public const URI = parent::URI . '/rm_contact_from_group';

    /**
     * Contact's mobile number.
     * 
     * Required.
     */
    public const MSISDN = 'msisdn';

    /**
     * Remove stated contact from this group.
     * 
     * Requried.
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
