DELETE products

GET products/_mapping

PUT products
{
  "mappings": {
    "properties": {
      "created_at": {
        "type": "date",
        "format": "yyyy-MM-dd"
      },
      "variants": {
        "type": "nested"
      }
    }
  }
}

POST _bulk
{"index":{"_index":"products","_id":"1"}}
{"id":1,"title":"Altınyıldız Classics Yarım Balıkçı Standart Düz Lacivert Erkek Kazak","price":150.0,"product_code":"2025571","created_at":"2021-10-31","status":false,"discount_rate":0,"brand":"Altınyıldız","variants":[{"size":"M","color":"gray"},{"size":"S","color":"red"}]}
{"index":{"_index":"products","_id":"2"}}
{"id":2,"title":"Beymen Business Bisiklet Yaka Siyah Erkek Kazak","price":250,"product_code":"2025572","created_at":"2021-09-30","status":false,"discount_rate":10,"brand":"Beymen","variants":[{"size":"M","color":"gray"},{"size":"S","color":"red"},{"size":"L","color":"blue"}]}
{"index":{"_index":"products","_id":"3"}}
{"id":3,"title":"Altınyıldız Classics Kazak","price":120,"product_code":"2025573","created_at":"2020-09-29","status":false,"discount_rate":20,"brand":"Altınyıldız","variants":[{"size":"M","color":"gray"},{"size":"S","color":"red"},{"size":"L","color":"blue"},{"size":"XL","color":"blue"}]}
{"index":{"_index":"products","_id":"4"}}
{"id":4,"title":"Limon Over İndigo Melanj Bisiklet Yaka Erkek Kazak","price":320,"product_code":"2025574","created_at":"2021-09-10","status":false,"discount_rate":30,"brand":"Limon","variants":[{"size":"M","color":"gray"},{"size":"S","color":"red"},{"size":"L","color":"blue"},{"size":"XL","color":"blue"}]}
{"index":{"_index":"products","_id":"5"}}
{"id":5,"title":"Limon Örgü Desen Siyah Erkek Kazak","price":220,"product_code":"2025575","created_at":"2021-09-19","status":false,"discount_rate":5,"brand":"Limon","variants":[{"size":"M","color":"gray"},{"size":"S","color":"red"},{"size":"L","color":"blue"},{"size":"XL","color":"blue"}]}
{"index":{"_index":"products","_id":"6"}}
{"id":6,"title":"Limon Bisiklet Yaka Ekru Kazak","price":139,"product_code":"2025576","created_at":"2021-09-20","status":false,"discount_rate":15,"brand":"Limon","variants":[{"size":"M","color":"gray"},{"size":"XS","color":"green"},{"size":"L","color":"blue"},{"size":"XL","color":"blue"}]}
{"index":{"_index":"products","_id":"7"}}
{"id":7,"title":"Fabrika Comfort Vizon Erkek Kazak","price":113,"product_code":"2025577","created_at":"2021-09-23","status":false,"discount_rate":15,"brand":"Fabrika","variants":[{"size":"M","color":"gray"},{"size":"XS","color":"green"},{"size":"L","color":"gray"},{"size":"XL","color":"blue"}]}
{"index":{"_index":"products","_id":"8"}}
{"id":8,"title":"Fabrika Bordo Melanj Erkek Kazak","price":429,"product_code":"2025578","created_at":"2021-09-25","status":false,"discount_rate":40,"brand":"Fabrika","variants":[{"size":"M","color":"gray"},{"size":"XS","color":"green"},{"size":"L","color":"gray"},{"size":"XL","color":"blue"}]}
{"index":{"_index":"products","_id":"9"}}
{"id":9,"title":"Mavi Hırka","price":173,"product_code":"2025579","created_at":"2021-09-29","status":false,"discount_rate":25,"brand":"Mavi","variants":[{"size":"M","color":"gray"},{"size":"XS","color":"green"},{"size":"L","color":"gray"},{"size":"XL","color":"blue"}]}
{"index":{"_index":"products","_id":"10"}}
{"id":10,"title":"Mavi Hırka","price":236,"product_code":"2025580","created_at":"2021-08-29","status":false,"discount_rate":10,"brand":"Mavi","variants":[{"size":"M","color":"gray"},{"size":"XS","color":"green"},{"size":"L","color":"gray"},{"size":"XL","color":"blue"}]}

GET products/_doc/10

GET products/_search
{
  "query": {
    "match": {
      "title": "shirt"
    }
  }
}

GET products/_search
{
  "query": {
    "bool": {
      "filter": [
        {
          "nested": {
            "path": "variants",
            "query": {
              "term": {
                "variants.color.keyword": "green"
              }
            }
          }
        },
        {
          "nested": {
            "path": "variants",
            "query": {
              "term": {
                "variants.size.keyword": "M"
              }
            }
          }
        }
      ]
    }
  }
}