<?php 

namespace Macure\JojkaSDK\Http\Options;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Add Contact Options 
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class AddContactOptions
{
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
     */
    public const GROUP = 'group';

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
            ->setRequired([self::MSISDN, self::NAME])
            ->setDefined([
                self::GROUP
            ]);
    }
}