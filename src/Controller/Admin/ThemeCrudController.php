<?php

namespace App\Controller\Admin;

use App\Entity\Theme;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichFileType;


class ThemeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Theme::class;
    }


    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setPageTitle('index', "Liste des Themes")
            ->setPageTitle(Crud::PAGE_NEW, 'Ajouter un theme')
            ->setPageTitle(Crud::PAGE_EDIT, 'Modifier un theme')
            ->setPageTitle(Crud::PAGE_DETAIL, 'Détailler un theme')
            ->setEntityLabelInSingular('Theme')
            ->setEntityLabelInPlural('Themes')
            ->setPaginatorPageSize(5);

    }


    public function configureFields(string $pageName): iterable
    {


        $panelTheme = FormField::addPanel("INFOS THEME");
        $id = IdField:: new('id')->onlyOnIndex();
        $rubrique = AssociationField::new('rubrique');
        $commentaire = AssociationField::new('commentaire');
        $nom = TextField::new('nom', "Nom du theme");
        $description = TextEditorField::new('description');
        $slug = SlugField::new('slug') ->setTargetFieldName ('nom');
        $top5 =TextEditorField::new('top5', "Top 5");
        $createdAt =DateTimeField::new('createdAt', 'Date de création');
        $updatedAt =DateTimeField::new('updatedAt', 'Date de modification');




        $affichageThemes = [
            $panelTheme, $id, $nom, $description, $slug, $top5, $createdAt, $updatedAt, $rubrique, $commentaire];

        $panelImages = FormField::addPanel("INFOS IMAGES");
        $nomPhoto = ImageField::new('nomPhoto')
            ->setFormType(VichFileType::class)
            ->setBasePath('/images/themes')
            ->hideOnForm();

        $fichierPhoto = VichImageField::new('fichierPhoto', 'Photo')
            ->onlyOnForms();

        $affichageImages = [$panelImages, $nomPhoto, $fichierPhoto];

        return array_merge($affichageThemes, $affichageImages);
    }

}
