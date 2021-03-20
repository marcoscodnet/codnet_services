<?php
namespace Cose\dao\impl\types;

use Cose\utils\ReflectionUtils;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * 
 * Tipo de datos Doctrine para mapear enumerativos.
 * 
 * La idea es mapear el nombre de la clase.
 * 
 * @author bernardo
 * @since 02/09/2015
 */
class EnumDoctrineType extends Type
{
    const TYPE = 'cose_enum';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        // return the SQL used to create your column type. To create a portable column type, use the $platform.
        return $platform->getVarcharTypeDeclarationSQL($fieldDeclaration);
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        // This is executed when the value is read from the database. Make your conversions here, optionally using the $platform.
        return ReflectionUtils::newInstance( $value );
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        // This is executed when the value is written to the database. Make your conversions here, optionally using the $platform.
        return get_class($value);
    }

    public function getName()
    {
        return self::TYPE; // modify to match your constant name
    }
}