
<?php
   $apiKey = "goldapi-ebzvslv3ai1hr-io";
   $symbol = "XAU";
   $currencies = [
       "EGP" => "جنية مصرية",
       "SAR" => "ريال سعودي",
       // "QAR" => "ريال قطري",
       "AED" => "درهم إماراتي",
       "KWD" => "دينار كويتي",
       //"BHD" => "دينار بحريني",
       "OMR" => "ريال عماني",
       //"IQD" => "دينار iraqي",
       "JOD" => "دينار أردني",
       "USD" => "دولار أمريكي"
      
   ];
   $coutry = [
    "EGP" => "مصر",
    "SAR" => "سعودية",
    // "QAR" => "قطر",
    "AED" => "الإمارات",
    "KWD" => "كويت",
    //"BHD" => "بحرين",
    "OMR" => "عمان",
    //"IQD" => "iraq",
    "JOD" => "الأردن",
    "USD" => "الولايات المتحدة"
   
];
   $curr = isset($_GET["curr"]) ? $_GET["curr"] : "EGP";
   $date = "";

   $myHeaders = array(
       'x-access-token: ' . $apiKey,
       'Content-Type: application/json'
   );

   $curl = curl_init();

   $url = "https://www.goldapi.io/api/{$symbol}/{$curr}{$date}";

   curl_setopt_array($curl, array(
       CURLOPT_URL => $url,
       CURLOPT_RETURNTRANSFER => true,
       CURLOPT_FOLLOWLOCATION => true,
       CURLOPT_HTTPHEADER => $myHeaders
   ));

   $response = curl_exec($curl);
   $error = curl_error($curl);

   curl_close($curl);
  ?>
<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <title>سعر الذهب مباشر الآن - في <?php echo $coutry[$curr];?> - <?php echo date('Y-m-d');?></title>
    <meta name="description" content="عرض سعر الذهب المباشر الآن في مصر والأردن والعالم. يمكنك تغيير العملة والبلد بسهولة ويتم تحديث السعر بشكل دوري">
    <meta name="keywords" content="سعر الذهب, مباشر, مصر, الأردن, العالم, عملة, بلد, تغيير, دوري, اسعار الذهب">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="gold.png" width="30" height="30" class="d-inline-block align-top" alt="">
            Gold Price
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            العملات
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="goldprice.php?currency=SAR">SAR</a>
                            <a class="dropdown-item" href="goldprice.php?currency=EGP">EGP</a>
                            <a class="dropdown-item" href="goldprice.php?currency=AED">AED</a>
                            <a class="dropdown-item" href="goldprice.php?currency=KWD">KWD</a>
                            <a class="dropdown-item" href="goldprice.php?currency=OMR">OMR</a>
                            <a class="dropdown-item" href="goldprice.php?currency=JOD">JOD</a>
                        </div>
                    </li>
                </ul>
    </nav>
    <hr>

<div class="container-fluid">
    <div class="card mx-auto" style="max-width: 300px;">
        <div class="card-header bg-primary text-white">
            Gold Price
        </div>
        <div class="card-body">
            <?php
           

            if ($error) {
                echo 'Error: ' . $error;
            } else {
                $response = json_decode($response);
                echo '<div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">العملة</label>
                </div>
                <select class="custom-select" id="inputGroupSelect01" onchange="window.location.href = \'goldprice.php?curr=\' + this.value">
                    <option selected>'.$currencies[$curr].'</option>';
                foreach ($currencies as $key => $value) {
                    echo '<option value="'.$key.'">'.$value.'</option>';
                }
                echo '</select>
            </div>';
                echo '<table class="table table-bordered">
                <thead>
                    <tr>
                        <th>العيار</th>
                        <th>السعر</th>
                    </tr>
                </thead>
                <tbody>';
                echo '<tr><td>عيار 24</td><td>'.$response->price_gram_24k.'</td></tr>';
                echo '<tr><td>عيار 22</td><td>'.$response->price_gram_22k.'</td></tr>';
                echo '<tr><td>عيار 21</td><td>'.$response->price_gram_21k.'</td></tr>';
                echo '<tr><td>عيار 20</td><td>'.$response->price_gram_20k.'</td></tr>';
                echo '<tr><td>عيار 18</td><td>'.$response->price_gram_18k.'</td></tr>';
                echo '<tr><td>عيار 16</td><td>'.$response->price_gram_16k.'</td></tr>';
                echo '<tr><td>عيار 14</td><td>'.$response->price_gram_14k.'</td></tr>';
                echo '<tr><td>عيار 10</td><td>'.$response->price_gram_10k.'</td></tr>';
                echo '</tbody>
                </table>';
            }
            ?>

        </div>
            <p class="text-center">
                تاريخ اليوم: <?php echo date('Y-m-d'); ?>
            </p>
    </div>
</div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>

</html>

