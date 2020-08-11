<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->

        <script src="https://cdn.jsdelivr.net/npm/algoliasearch@4.0.0/dist/algoliasearch-lite.umd.js" integrity="sha256-MfeKq2Aw9VAkaE9Caes2NOxQf6vUa8Av0JqcUXUGkd0=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/instantsearch.js@4.0.0/dist/instantsearch.production.min.js" integrity="sha256-6S7q0JJs/Kx4kb/fv0oMjS855QTz5Rc2hh9AkIUjUsk=" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/instantsearch.css@7.3.1/themes/algolia-min.css" integrity="sha256-HB49n/BZjuqiCtQQf49OdZn63XuKFaxcIHWf0HNKte8=" crossorigin="anonymous">

    </head>
    <body>

        <div id="searchbox" style="padding:8px"></div>
        <div id="range-slider"></div>
        <div id="hits" style="padding:8px"></div>
        <div id="pagination"></div>

        <script type="text/javascript">

            const searchClient = algoliasearch(
                '{{config("scout.algolia.id")}}', 
                '{{Algolia\ScoutExtended\Facades\Algolia::searchKey(App\Product::class)}}'
            );

            const search = instantsearch({
                indexName: 'products',
                searchClient,
                routing: {
                    stateMapping: instantsearch.stateMappings.simple(),
                },
                });

            search.addWidgets([
                instantsearch.widgets.searchBox({
                    container: '#searchbox',
                }),

                instantsearch.widgets.hits({
                    container: '#hits',
                    templates: {
                        item: `
                            <h2>@{{title}}</h2>
                            <p>@{{description}}</p>
                            <strong>@{{price}}$</strong>
                        `
                    },
                }),
                instantsearch.widgets.pagination({
                    container: '#pagination',
                }),

                instantsearch.widgets.rangeSlider({
                    container: '#range-slider',
                    attribute: 'price',
                    min: 0,
                    max: 100,
                }),

                instantsearch.widgets.configure({
                    hitsPerPage: 8,
                }),

            ]);

            search.start();
        </script>
    </body>
</html>
