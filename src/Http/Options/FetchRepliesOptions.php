<?php

namespace Macure\JojkaSDK\Http\Options;

use DateTime;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\Exception\InvalidOptionsException;

/**
 * Fetch Replies Options class
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class FetchRepliesOptions
{
    /**
     * Only fetch messages with this sender.
     * 
     * Optional.
     */
    public const FROM_MSISDN = 'from_msisdn';

    /**
     * Only fetch messages received later than this time. Must be given in the format “Y-m-d H:i:s”, for example “2016-05-31 12:58:05”.
     * 
     * Messages a maximum of 96 hours old are fetched.
     * 
     * If the parameter is left out, all messages that have come in over the last 96 hours are fetched.
     * 
     * Optional.
     */
    public const SINCE_TIME = 'since_time';

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
            ->setDefined([self::FROM_MSISDN, self::SINCE_TIME])
            ->setNormalizer(self::SINCE_TIME, function (Options $options, $value) {
                if (DateTime::createFromFormat('Y-m-d H:i:s', $value)) {
                    return $value;
                }
                
                throw new InvalidOptionsException(sprintf('Optional parameter %s must be given in the format "Y-m-d H:i:s".', self::SINCE_TIME));
            });
    }
}
