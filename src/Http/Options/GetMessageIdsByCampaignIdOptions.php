<?php

namespace Macure\JojkaSDK\Http\Options;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Get messages ids by campaignId Options class
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class GetMessageIdsByCampaignIdOptions
{
    /**
     * The ID of the campaign whose SMS ID is requested.
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
