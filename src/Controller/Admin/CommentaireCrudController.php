<?php

namespace App\Controller\Admin;

use App\Entity\Commentaire;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CommentaireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Commentaire::class;
    }


    public function configureCrud(Crud $crud): Crud

{
return parent::configureCrud($crud)
        ->setPageTitle('index', "Liste des Commentaires")
        ->setEntityLabelInSingular('Commentaire')
        ->setEntityLabelInPlural('Commentaires')
        ->setPaginatorPageSize(9);

}
    public function configureFields(string $pageName): iterable
    {
        return[

            TextField::new('contenu', "Contenu"),
            NumberField::new('note', "Note"),
            AssociationField::new('user', 'User')
        ];

    }

}
