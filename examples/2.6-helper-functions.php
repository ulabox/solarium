<?php

require('init.php');
htmlHeader();

// create a client instance
$client = new Solarium_Client($config);

// get a select query instance and a query helper instance
$query = $client->createSelect();
$helper = $query->getHelper();

// add a filterquery on a price range, using the helper to generate the range
$fqPrice = $query->createFilterQuery();
$fqPrice->setKey('price');
$fqPrice->setQuery($helper->rangeQuery('price', 10, 300));
$query->addFilterQuery($fqPrice);

// add a filterquery to find products in a range of 5km, using the helper to generate the 'geofilt' filter
$fqRegion = $query->createFilterQuery();
$fqRegion->setKey('region');
$fqRegion->setQuery($helper->geofilt(45.15, -93.85, 'store', 5));
$query->addFilterQuery($fqRegion);

// this executes the query and returns the result
$resultset = $client->select($query);

// display the total number of documents found by solr
echo 'NumFound: '.$resultset->getNumFound();

// show documents using the resultset iterator
foreach ($resultset as $document) {

    echo '<hr/><table>';

    // the documents are also iterable, to get all fields
    foreach($document AS $field => $value)
    {
        // this converts multivalue fields to a comma-separated string
        if(is_array($value)) $value = implode(', ', $value);
        
        echo '<tr><th>' . $field . '</th><td>' . $value . '</td></tr>';
    }

    echo '</table>';
}

htmlFooter();