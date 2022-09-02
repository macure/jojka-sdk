<?php

namespace Macure\JojkaSDK\Http\Requests;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Get messages ids by campaignId request class
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class GetMessageIdsByCampaignIdRequest extends Request
{
    public const URI = parent::URI . '/get_msg_ids_by_campaign_id';

    /**
     * The ID of the campaign whose SMS ID is requested.
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
