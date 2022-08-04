<?php

namespace Macure\JojkaSDK\Http\Requests;

use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\Exception\InvalidOptionsException;

/**
 * Send request class
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class SendRequest extends Request
{
    public const URI = parent::URI . '/send';

    /**
     * A mobile number received by the SMS
     * 
     * Required.
     */
    public const TO = 'to';

    /**
     * The SMS contents.
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
     * {@inheritDoc}
     */
    protected function configure(OptionsResolver $resolver) 
    {
        parent::configure($resolver);
        
        $resolver
            ->setDefined(self::FROM)
            ->setRequired([self::TO, self::MSG]);

        $resolver->setNormalizer(self::FROM, function (Options $options, $value) {
            if (preg_match('/^[a-zA-Z0-9-_]+$/m', $value) && strlen($value) <= 11) {
                return $value;
            }

            throw new InvalidOptionsException(sprintf('Optional parameter %s is restricted to a-z, A-Z, 0-9 and separators such as - and _. Max 11 characters', self::FROM));
        });
    }
}
