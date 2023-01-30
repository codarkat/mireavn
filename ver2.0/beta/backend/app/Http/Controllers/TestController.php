<?php

namespace App\Http\Controllers;

use FiveamCode\LaravelNotionApi\Query\Sorting;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class TestController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }

    public function test()
    {
//        $pages = \Notion::search()
//            ->onlyPages()
//            ->query()
//            ->asCollection();
//        foreach ($pages as $page) {
//            print($page->getTitle());
//            print($page->getUrl());
//        }

        $databaseId = '506a1f3f0ef345b18c0cf8af67de86fc';
        $database = \Notion::databases()
            ->find($databaseId);
//# Get database title
        // print($database->getTitle());

//# Get property-information of the database
//        print($database->getProperties());

//# Get all keys of the properties (property-namprinte(s)
//        print($database->getPropertyKeys());

# Get database icon and icon-type (emoji, file, external)
//        print($database->getIcon());
//        print($database->getIconType());
//
//# Get database cover and cover-type (file, external)
//        print($database->getCover());
//        print($database->getCoverType());
//
//# Get database url (within Notion)
//        print($database->getUrl());

# Queries a specific database and returns a collection of pages (= database entries)
//        $sortings = new Collection();
//
//        $sortings
//            ->add(Sorting::propertySort("TIME", "ascending"));

# the whole query
        // $data = \Notion::database($databaseId)
        //     ->query()
        //     ->asCollection();

        $sortings = new Collection();
        $filters = new Collection();

        $sortings
            ->add(Sorting::propertySort('Thời gian', 'ascending'));

        $data = \Notion::database($databaseId)
            ->sortBy($sortings) // sorts are optional
            ->query()
            ->asCollection();

        foreach ($data as $dt) {
            $pageId = substr($dt->getUrl(), -32);
            echo $pageId, ' - ["', $dt->getTitle(), '"] ', "<br />";
            // echo "xxx------------------------------xxx", "<br />";
//            $blocks = \Notion::pages($pageId)
//                ->query()->asCollection();
//
//            foreach ($blocks as $bl) {
//                echo $bl->retrieve(), "<br />";
//            }
            // echo \Notion::block($pageId)
            //         ->children()
            //     ->withUnsupported()
            //     ->asCollection();

            // echo "xxx------------------------------xxx", "<br />";

        }

    }
}
