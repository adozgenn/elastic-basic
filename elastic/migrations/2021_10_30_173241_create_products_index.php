<?php
declare(strict_types=1);


use ElasticMigrations\Facades\Index;
use ElasticMigrations\MigrationInterface;


final class CreateProductsIndex implements MigrationInterface
{
    /**
     * Run the migration.
     */
    public function up(): void
    {
        $mapping = [
            'properties' => [
                'title' => [
                    'type' => 'text'
                ]
            ]
        ];

        $settings = [
            'number_of_replicas' => 2
        ];

        Index::createRaw('products', $mapping, $settings);
    }

    /**
     * Reverse the migration.
     */
    public function down(): void
    {
        Index::dropIfExists('products');
    }
}
