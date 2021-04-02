<?php


namespace App\Controller\Admin;



use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;
use Vich\UploaderBundle\Form\Type\VichImageType;

class VichImageField implements FieldInterface

{
    use FieldTrait;

    public static function new(string $propertyName, ?string $label = null): self
    {

            return (new self())
                ->setProperty($propertyName)
                ->setLabel($label)
                ->setTemplatePath('')
                ->setFormType(VichImageType::class);
        }
    }