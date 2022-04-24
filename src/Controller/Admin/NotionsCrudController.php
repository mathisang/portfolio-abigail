<?php

namespace App\Controller\Admin;

use App\Entity\Notions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class NotionsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Notions::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
