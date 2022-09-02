<?php

namespace Macure\JojkaSDK\Http\Requests;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Get message status request class
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class GetMessageStatusRequest extends Request
{
    public const URI = parent::URI . '/get_msg_status';

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
    protected function configure(OptionsResolver $resolver) 
    {
        parent::configure($resolver);
        
        $resolver->setRequired(self::MSG_ID);
    }
}
