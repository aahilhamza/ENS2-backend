<?php

$domain = $_GET['domain'];
$token  = intval($_GET['tokenId']);

if($token <= 999) {
    $club = '999 Club';
} elseif($token <= 10000){
    $club = '10k Club';
} elseif($token <= 100000) {
    $club = '100k Club';
} else {
    $club = false;
}


if(is_numeric($domain)) {
    $type = 'Digits';
} elseif (!preg_match('/[0-9]/', $domain)) {
    $type = 'Letters';
} else {
    $type = 'Mixed';
}

$metaData = [
    "name" =>  $domain,

  "description" => $domain . ".ethereum, an ethereum name.",
  "attributes" =>  [
    [
        "trait_type"=> "Character Set",
      "display_type"=>  "string",
      "value"=> $type // If MYNAME is only Alphabets then: "Letters", If AlphaNumerical: "Mixed", If Numbers only: "Digits"
    ],
  ],
    "name_length" => strlen($domain), // length of MYNAME
    "url"=> 'https://metadata.ethname.domains/' . $token .'/' . $domain,
    "image_url"=> 'https://metadata.ethname.domains/images/' . $token .'/' . $domain,
];
if($club){
    $metaData['attributes'][] = [
        "trait_type"=> "Club",
        "display_type"=> "string",
        "value"=> $club  // Check saved JSONs so far, If saved < 999: '999 Club', else if saved < 10000: '10K Club', else if saved < 10000: '100K Club'
    ];
}
header('Content-Type: application/json; charset=utf-8');
echo json_encode($metaData);
exit();