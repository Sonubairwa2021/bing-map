<?php
$api_key = "";
$query = urlencode($_GET['query']);

if ($query) {
    $url = "https://dev.virtualearth.net/REST/v1/Locations/US/$query?o=json&key=$api_key";

    $response = file_get_contents($url);

    if ($response) {
        $responseObject = json_decode($response);

        if ($responseObject === null) {
            echo "Error decoding JSON response.";
        } else {
            $data['locations'] = array();
            $resourceSets = $responseObject->resourceSets;
            foreach ($resourceSets as $resourceSet) {
                // Access the 'resources' array within each resource set
                $resources = $resourceSet->resources;

                // Loop through each resource
                foreach ($resources as $resource) {
                    $name = @$resource->name;
                        $latitude = @number_format($resource->point->coordinates[0], 6);
                        $longitude = @number_format($resource->point->coordinates[1], 6);
                        $state = @$resource->address->adminDistrict;
                        $addressLine = @$resource->address->addressLine;
                        $city = @$resource->address->locality;
                        $formattedAddress = @$resource->address->formattedAddress;
                        $postalCode = @$resource->address->postalCode;

                        echo "<div class='autocomplete-item' 
                        data-name='$name' 
                        data-addressLine='$addressLine' 
                        data-formattedAddress='$formattedAddress' 
                        data-latitude='$latitude' 
                        data-longitude='$longitude' 
                        data-postalCode='$postalCode' 
                        data-city='$city' 
                        data-state='$state'> $formattedAddress, $city, $state </div>";
                }
            }

            
        }
    } else {
        echo "Error fetching response from API.";
    }
}
?>
