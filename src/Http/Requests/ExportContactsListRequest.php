<?php

namespace Macure\JojkaSDK\Http\Requests;

use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\Exception\InvalidOptionsException;

/**
 * Export contacts list request 
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class ExportContactsListRequest extends Request
{
    public const URI = parent::URI . '/export_contacts_list';
    
    /**
     * Maximum number of contacts in this call.
     * Maximum value is 10000. If the parameter is not stated, the value will be 100.
     * 
     * Optional.
     */
    public const MAX = 'max'; 

    /**
     * Ignore this many contacts before the export starts. If the parameter is not stated, the value will be 0.
     * 
     * Optional.
     */
    public const OFFSET = 'offset';

    /**
     * {@inheritDoc}
     */
    protected function configure(OptionsResolver $resolver) 
    {
        parent::configure($resolver);
        
        $resolver
            ->setDefaults([self::MAX => 100, self::OFFSET => 0]);

        $resolver->setNormalizer(self::MAX, function (Options $options, $value) {
            if (10000 < $value || $value < 0) {
                throw new InvalidOptionsException(sprintf('Optional parameter %s must be between 0 and 10000', self::MAX));
            }
            
            return $value;
        });

        $resolver->setNormalizer(self::OFFSET, function (Options $options, $value) {
            if ($value < 0) {
                throw new InvalidOptionsException(sprintf('Optional parameter %s must be higher than, or 0', self::OFFSET));
            }
            
            return $value;
        });
    }
}
