<?php

namespace App\Controller\Admin;

use App\Entity\Movie;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class MovieCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Movie::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
            $mappingParams = $this->getParameter('vich_uploader.mappings');

            $moviesImagePath = $mappingParams['movies']['uri_prefix'];

            yield TextField::new('name', 'Nom du film');
            yield IntegerField::new('release_year', 'Année de sortie');
            yield TimeField::new('duration', 'Duree');
            yield TextEditorField::new('synopsis', 'Synopsis');
            yield TextareaField::new('imageFile')->setFormType(VichImageType::class)->hideOnIndex();
            yield ImageField::new('imageName', 'Affiche')->setBasePath($moviesImagePath)->hideOnForm();
            yield AssociationField::new('director', 'Réalisateurs');
            yield AssociationField::new('genre', 'Genre');
    }
    
}
