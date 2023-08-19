<?php 
$query =urlencode( $_GET['query']);
$url ="https://dev.virtualearth.net/REST/v1/Locations/US/$query?o=json&key=$api_key";

$response =  file_get_contents($url);

if($response)
$responseObject = json_decode($response);

if ($responseObject === null) {
    echo "Error decoding JSON response.";
} else {
    // Access the 'resourceSets' array
    $resourceSets = $responseObject->resourceSets;

    // Loop through each resource set
    foreach ($resourceSets as $resourceSet) {
        // Access the 'resources' array within each resource set
        $resources = $resourceSet->resources;

        // Loop through each resource
        foreach ($resources as $resource) {
          //  echo json_encode($resource);
            // Access individual properties of the resource
            $name = $resource->name;
            $coordinates = $resource->point->coordinates;
            $adminDistrict = $resource->address->adminDistrict;
             $addressLine = $resource->address->addressLine;
            @$adminDistrict = $resource->address->adminDistrict;
            @$locality = $resource->address->locality;
            @$formattedAddress = $resource->address->formattedAddress;
            @$postalCode = $resource->address->postalCode;

  
            // ... (access other properties you need)

            // Output or process the extracted information
            echo "Name: $name<br>";
            echo "Coordinates: Latitude: {$coordinates[0]}, Longitude: {$coordinates[1]}<br>";
            echo "Admin District: $adminDistrict<br>";
              echo "Address Line: " . $addressLine . "<br>";
    echo "Locality: " . $locality . "<br>";
    echo "Formatted Address: " . $formattedAddress . "<br>";
    echo "postal code: " . $postalCode . "<br>";
            echo "<hr>";
        }
    }
}

?>