<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $Crud): crud
{
    return parent::configureCrud($Crud)
    ->setEntityLabelInSingular('User')
    ->setEntityLabelInPlural('Users')
    ->setPageTitle('index', "Liste des users")
    ->setPageTitle(Crud::PAGE_NEW, 'Ajouter un user')
    ->setPageTitle(Crud::PAGE_EDIT, 'Modifier un user')
    ->setPageTitle(Crud::PAGE_DETAIL, 'Détailler un user')
    ->setPaginatorPageSize(5);

}


    public function configureFields(string $pageName): iterable
    {
        return [

            IdField::new('id')->hideOnForm(),
            TextField::new('prenom', 'Prénom'),
            TextField::new('email', 'Email'),
            ArrayField::new('roles', 'Roles'),
            DateTimeField::new('createdAt', 'Date de création'),
            DateTimeField::new('updatedAt', 'Date de modification'),
        ];


    }
}
