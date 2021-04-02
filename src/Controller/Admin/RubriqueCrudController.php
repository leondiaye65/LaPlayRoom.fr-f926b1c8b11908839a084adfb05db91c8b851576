<?php

namespace App\Controller\Admin;

use App\Entity\Rubrique;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RubriqueCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Rubrique::class;
    }


    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setPageTitle('index', "Liste des Rubriques")
            ->setPageTitle(Crud::PAGE_NEW, 'Ajouter une rubrique')
            ->setPageTitle(Crud::PAGE_EDIT, 'Modifier une rubrique')
            ->setPageTitle(crud::PAGE_DETAIL, 'Détailler une Rubrique')
            ->setEntityLabelInSingular('Rubrique')
            ->setEntityLabelInPlural('Rubriques')
            ->setPaginatorPageSize(4);


    }


    public function configureFields(string $pageName): iterable


    {

        $nom = TextField::new('nom', "nom");
        $description = TextEditorField::new('description', "Description");
        $slug = SlugField::new('slug') ->setTargetFieldName('nom');
        $createdAt = DateTimeField::new('createdAt', 'Date de création');
        $updatedAt = DateTimeField::new('updatedAt', 'Date de modification');


        if($pageName=== Crud::PAGE_INDEX || $pageName=== Crud::PAGE_DETAIL) {
            $champ = [$nom, $description, $slug, $createdAt, $updatedAt];
        }else{
            $champ = [$nom, $description, $slug,];
        }

        return $champ;
    }

}
