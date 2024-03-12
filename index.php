<?php

/**
 * PHP starts here.
 */

/**
 * Import the Field Class.
 */

require("./Fields.php");
$fieldArray = fieldServices();

function fieldServices()
{
  $fieldArray = [];

  $arr_body = (new FetchApi('https://www.innoraft.com/jsonapi/node/services'))->apiCall();

  foreach ($arr_body['data'] as $data) {
    $baseUrl = "https://www.innoraft.com"; // Set the base url.

    /**
     * Check of the service title is null or not.
     * 
     * If not null then fetch the all required data.
     * 1. Field title.
     * 2. Field services links.
     * 3. Field images.
     * 4. Respective self url of particular service.
     * 5. Respective service icons.
     * 
     */
    if (($data['attributes']['field_secondary_title']) != NULL) {
      $iconsArr = [];
      $fieldTitle = $data['attributes']['field_secondary_title']['value'];
      $fieldService =  $data['attributes']['field_services']['value'];
      $fieldImage = $baseUrl . (new FetchApi($data['relationships']['field_image']['links']['related']['href']))->apiCall()['data']['attributes']['uri']['url'];
      $alias = $baseUrl . $data['attributes']['path']['alias'];
      $fieldIcons = (new FetchApi($data['relationships']['field_service_icon']['links']['related']['href']))->apiCall()['data'];

      for ($i = 0; $i < count($fieldIcons); $i++) {
        $iconArray = $baseUrl . (new FetchApi($fieldIcons[$i]['relationships']['field_media_image']['links']['related']['href']))->apiCall()['data']['attributes']['uri']['url'];
        $iconsArr[] = $iconArray;
      }
      $obj = new Field($fieldImage, $fieldTitle, $alias, $fieldService, $iconsArr);
      $fieldArray[] = $obj;
    }
  }
  return $fieldArray;
}

/**
 * PHP ends here.
 */
?>

<!-- HTML starts here. -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <section class="services">
    <div class="container">

      <!-- Openning the for loop to display the data. -->
      <?php for ($i = 0; $i < count($fieldArray); $i++) {

        // Checking the data is empty or not.
        if (!empty($fieldArray[$i]->getFieldTitle())) {

          /**
           * Checking the data index is even or odd.
           * If even then texts and links are in right and image is left.
           */
          if ($i % 2 == 0) {
      ?>
            <div class="serviceContainer d-flex justify-content-center align-item-center">
              <div class="itemLinks">
                <h2>
                  <?php echo $fieldArray[$i]->getFieldTitle(); ?>
                </h2>
                <div class="servicesIcons d-flex">
                  <?php
                  for ($j = 0; $j < $fieldArray[$i]->getFieldIconsLen(); $j++) { ?>

                    <div class="links">
                      <img class="icon" src="<?php echo $fieldArray[$i]->getFieldIcons()[$j]; ?>" alt="">
                    </div>
                  <?php } ?>
                </div>
                <div class="links">
                  <?php echo $fieldArray[$i]->getFieldService(); ?>
                </div>
                <a class="btn" href="<?php echo $fieldArray[$i]->getAlias() ?>">Explore More</a>
              </div>
              <div class="itemImg">
                <img src="<?php echo $fieldArray[$i]->getFieldImage() ?>" alt="">
              </div>
            </div>
          <?php }

          /**
           * Checking the data index is even or odd.
           * If odd then texts and links are in left and image is right.
           */
          else { ?>
            <div class="serviceContainer d-flex justify-content-center align-item-center">
              <div class="itemImg">
                <img src="<?php echo $fieldArray[$i]->getFieldImage() ?>" alt="">
              </div>
              <div class="itemLinks">
                <h2>
                  <?php echo $fieldArray[$i]->getFieldTitle(); ?>
                </h2>
                <div class="servicesIcons d-flex">
                  <?php
                  for ($j = 0; $j < $fieldArray[$i]->getFieldIconsLen(); $j++) { ?>
                    <div class="links">
                      <img class="icon" src="<?php echo $fieldArray[$i]->getFieldIcons()[$j]; ?>" alt="">
                    </div>
                  <?php }?>
                </div>
                <div class="links">
                  <?php echo $fieldArray[$i]->getFieldService(); ?>
                </div>
                <a class="btn" href="<?php echo $fieldArray[$i]->getAlias() ?>">Explore More</a>
              </div>
            </div>
      <?php }
        }
      } ?>
    </div>
  </section>
</body>

</html>
<!-- HTML ends here. -->