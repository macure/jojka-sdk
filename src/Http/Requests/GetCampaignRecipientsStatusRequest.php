<?php

namespace Macure\JojkaSDK\Http\Requests;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Get campaign recipients status request class
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class GetCampaignRecipientsStatusRequest extends Request
{
    public const URI = parent::URI . '/get_campaign_recipients_status';
    
    /**
     * Campaign ID that you have got when you've sent a campaign.
     * 
     * Required.
     */
    public const CAMPAIGN_ID = 'campaign_id';

    /**
     * {@inheritDoc}
     */
    protected function configure(OptionsResolver $resolver) 
    {
        parent::configure($resolver);
        
        $resolver->setRequired(self::CAMPAIGN_ID);
    }
}
