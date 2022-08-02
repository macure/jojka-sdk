<?php

namespace Macure\JojkaSDK\Http\Options;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Get Campaign Recipients Status Options class
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class GetCampaignRecipientsStatusOptions
{
    /**
     * Campaign ID that you have got when you've sent a campaign.
     * 
     * Required.
     */
    public const CAMPAIGN_ID = 'campaign_id';

    /**
     * Configure options
     *
     * @param OptionsResolver $resolver
     *
     * @return void
     */
    public static function configure(OptionsResolver $resolver) 
    {
        $resolver->setRequired(self::CAMPAIGN_ID);
    }
}
