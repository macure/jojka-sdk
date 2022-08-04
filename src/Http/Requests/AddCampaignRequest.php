<?php 

namespace Macure\JojkaSDK\Http\Requests;

use DateTime;
use Macure\JojkaSDK\Http\Requests\Request;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\Exception\InvalidOptionsException;
use Symfony\Component\OptionsResolver\Exception\MissingOptionsException;

/**
 * Add campaign request 
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class AddCampaignRequest extends Request
{
    public const URI = parent::URI . '/add_campaign';

    /**
     * One or more mobile numbers for the recipients of the SMS, separated by a semi-colon. 
     * Example: 
     *      46709771337;46709966666
     * 
     * Up to 1000 recipients can be specified in this way. For larger volumes multiple requests should be used.
     * 
     * Required as alternative.
     */
    public const TO_MSISDN = 'to_msisdn';

    /**
     * One or more contact groups that will receive the SMS, separated by a semi-colon. 
     * All contacts saved at Jojka and that are members of at least one of the listed groups will receive the SMS.
     * 
     * There is a special group named “all”. If this is stated, the SMS is sent to all contacts that you as a customer have saved in Jojka.
     * 
     * Required as alternative.
     */
    public const TO_GROUP = 'to_group';

    /**
     * Contents of the SMS.
     * 
     * Required.
     */
    public const MSG = 'msg';

    /**
     * Can be added to one or more specific pre-ordered sender names.
     * 
     * It is also possible to order free text names, this parameter can then be applied to any string, 
     * although restricted to a-z, A-Z, 0-9 and separators such as - and _. Max 11 characters.
     * 
     * Specific user names or free text names are ordered from Jojka.
     * 
     * If the parameter is left out, your account's Jojka number is used as sender.
     * 
     * Optional.
     */
    public const FROM = 'from';

    /**
     * Time when the campaign should start to be sent. Must be given in the format "YYYY-MM-DD hh:mm:ss"
     * Example:
     *      2016-05-31 12:18:52
     * 
     * Optional.
     */
    public const SCHEDULED = 'scheduled';

    /**
     * Campaign name. 
     * Only used for internal statistics and follow up, never shown to recipients of the campaign.
     * 
     * Optional.
     */
    public const NAME = 'name';

    /**
     * {@inheritDoc}
     */
    protected function configure(OptionsResolver $resolver) 
    {
        parent::configure($resolver);
        
        $resolver
            ->setRequired(self::MSG)
            ->setDefined([
                self::FROM, 
                self::NAME,
                self::TO_GROUP, 
                self::TO_MSISDN, 
                self::SCHEDULED, 
            ])
            ->setDefaults([
                self::TO_MSISDN => null, 
                self::TO_GROUP  => null
            ]);

        $resolver
            ->setNormalizer(self::TO_MSISDN, function (Options $options, $value) {
                if (null === $value xor null === $options[self::TO_GROUP]) {
                    return $value;
                }

                throw new MissingOptionsException(sprintf('Both %s, %s are null or both are provided', self::TO_MSISDN, self::TO_GROUP));
            })

            ->setNormalizer(self::FROM, function (Options $options, $value) {
                if (preg_match('/^[a-zA-Z0-9-_]+$/m', $value) && strlen($value) <= 11) {
                    return $value;
                }

                throw new InvalidOptionsException(sprintf('Optional parameter %s is restricted to a-z, A-Z, 0-9 and separators such as - and _. Max 11 characters', self::FROM));
            })
            ->setNormalizer(self::SCHEDULED, function (Options $options, $value) {
                if (DateTime::createFromFormat('Y-m-d H:i:s', $value)) {
                    return $value;
                }
                
                throw new InvalidOptionsException(sprintf('Optional parameter %s must be given in the format "Y-m-d H:i:s".', self::SCHEDULED));
            });
    }
}