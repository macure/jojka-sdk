<?php

namespace Macure\JojkaSDK\Http\Requests;

use DateTime;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Add contact request
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class AddContactRequest extends Request
{
    public const URI = parent::URI . '/add_contact';

    /**
     * Contact's mobile number. 
     * 
     * Required.
     */
    public const MSISDN = 'msisdn';

    /**
     * Contact's name.
     * 
     * Required
     */
    public const NAME = 'name';

    /**
     * One or several group names to share the contact, separated by semi-colon.
     * 
     * Optional.
     */
    public const GROUP = 'group';

    /**
     * {@inheritDoc}
     */
    protected function configure(OptionsResolver $resolver) 
    {
        parent::configure($resolver);

        $resolver
            ->setRequired([self::MSISDN, self::NAME])
            ->setDefined([
                self::GROUP
            ]);
    }
}
