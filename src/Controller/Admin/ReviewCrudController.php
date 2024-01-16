<?php

namespace App\Controller\Admin;

use App\Entity\Review;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class ReviewCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Review::class;
    }

    public function configureFields(string $pageName): iterable
    {
            yield from parent::configureFields($pageName);
            yield AssociationField::new('movie', 'film');
            yield ChoiceField::new('rate', 'note')->setChoices([
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5'
            ])->renderExpanded();
            yield TextareaField::new('review', 'avis');
            yield AssociationField::new('user', 'utilisateur');
    
    }
    
}
