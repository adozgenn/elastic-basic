<?php
declare(strict_types=1);

use ElasticAdapter\Indices\Mapping;
use ElasticAdapter\Indices\Settings;
use ElasticMigrations\Facades\Index;
use ElasticMigrations\MigrationInterface;

final class ChangeTagsColumnMappingToPostsIndex implements MigrationInterface
{
    /**
     * Run the migration.
     */
    public function up(): void
    {
        Index::putMapping('posts', function (Mapping $mapping) {
            $mapping->text('title', ['boost' => 2]);
        });

        Index::putSettingsHard('posts', function (Settings $settings) {
            $settings->analysis([
                'analyzer' => [
                    'title' => [
                        'type' => 'custom',
                        'tokenizer' => 'whitespace',
                    ]
                ]
            ]);
        });


    }

    /**
     * Reverse the migration.
     */
    public function down(): void
    {
        Index::putMapping('posts', function (Mapping $mapping) {
            $mapping->text('title');
        });
    }
}


PUT products
{
  "mappings": {
    "properties": {
      "title": {
        "type": "text"
      },
      "price": {
        "type": "float"
      },
      "product_code": {
        "type": "text"
      },
      "created_at": {
        "type": "date"
      },
      "status": {
        "type": "boolean"
      },
      "discount_rate": {
         "type": "integer"
      },
      "brand": {
        "type": "keyword"
      },
      "variants" : {
        "type": "nested"
      }
    }
  }
}

