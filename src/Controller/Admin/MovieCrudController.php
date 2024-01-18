<?php

namespace App\Controller\Admin;

use App\Entity\Movie;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;

class MovieCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Movie::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
            yield TextField::new('name', 'Nom du film');
            yield IntegerField::new('release_year', 'Année de sortie');
            yield TimeField::new('duration', 'Duree');
            yield AssociationField::new('director', 'Réalisateurs');
            yield AssociationField::new('genre', 'Genre');
            yield TextEditorField::new('synopsis', 'Synopsis');
    }
    
}
