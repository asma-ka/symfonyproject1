<?php
namespace App\DBAL\Types;
use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;
final Class RdvStatuType extends AbstractEnumType { 
    public const CREE = "cree";
    public const TRAITEE = "traitee";
    protected static $choices=[ 
        self::CREE=>"Crée",
        self::TRAITEE=>"Traitée"
    ];
}