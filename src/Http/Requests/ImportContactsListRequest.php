<?php

namespace Macure\JojkaSDK\Http\Requests;

use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\Exception\MissingOptionsException;

/**
 * Import contacts list request class
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class ImportContactsListRequest extends Request
{
    public const URI = parent::URI . '/import_contacts_list';

    /**
     * Array containg array with following keys: 'msisdn', 'name' and 'groups'.
     * [
     *     [
     *         'msisdn' => string,
     *         'name'   => string,
     *         'groups' => string[]
     *     ]
     * ]
     * 
     * 
     * Required as alternative.
     */
    public const CONTACTS_LIST = 'contacts_list';

    /**
     * A URL that points to a CSV formatted string.
     * 
     * Encoding: UTF-8 
     * Line break: \n 
     * Separators: , or ;
     * Text limiter: is missing
     * 
     * Columns:msisdn;name;group1;group2;group3;…
     * Note that because the text limiter is missing, the characters "," and ";" must not be used in any fields.
     * 
     * Required as alternative.
     */
    public const CONTACTS_LIST_URL = 'contacts_list_url';

    /**
     * {@inheritDoc}
     */
    protected function configure(OptionsResolver $resolver) 
    {
        parent::configure($resolver);
        
        $resolver
            ->setDefined([self::CONTACTS_LIST, self::CONTACTS_LIST_URL])
            ->setDefaults([
                self::CONTACTS_LIST => null, 
                self::CONTACTS_LIST_URL  => null
            ]);

        $resolver->setNormalizer(self::CONTACTS_LIST, function (Options $options, $value) {
            if (null === $value xor null === $options[self::CONTACTS_LIST_URL]) {

                if ($options[self::CONTACTS_LIST_URL]) {
                    return $value;
                }

                $rows     = [];
                $resolver = new OptionsResolver();

                foreach ($value as $row) {
                    $resolver->setRequired(['msisdn', 'name', 'groups']);
                    $row    = $resolver->resolve($row);
                    $rows[] = join(';', array_merge([$row['msisdn'], $row['name']], $row['groups']));
                }

                return join("\r\n", $rows);
            }
            
            throw new MissingOptionsException(sprintf('Both %s, %s are null or both are provided', self::CONTACTS_LIST, self::CONTACTS_LIST_URL));
        });
    }
}
