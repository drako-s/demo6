<?php
include_once('Db.php');
include_once('Utils.php');
include_once('credentials.php');

function loadConfig() {
if(file_exists('config.ini'))
    {
      $config = parse_ini_file("config.ini");
      return array("orderID" => $config["orderID"]);
    } else
    return array();
}

$configData = loadConfig();

$content = Db::queryOne('SELECT aboutus.*, contacts.*, metatags.*, domains.*, cta.*, headlines.*, opening_time.* FROM aboutus 
          LEFT JOIN contacts ON aboutus.order_id = contacts.order_id
          LEFT JOIN metatags ON aboutus.order_id = metatags.order_id
          LEFT JOIN domains ON aboutus.order_id = domains.order_id
          LEFT JOIN cta ON aboutus.order_id = cta.order_id
          LEFT JOIN headlines ON aboutus.order_id = headlines.order_id
          LEFT JOIN opening_time ON aboutus.order_id = opening_time.order_id
          WHERE aboutus.order_id = ?', array($configData['orderID']));

$features = Db::queryAll('SELECT * FROM `features` WHERE `order_id` = ?', array($configData['orderID']));
$faqs = Db::queryAll('SELECT * FROM `faq` WHERE `order_id` = ?', array($configData['orderID']));
$services = Db::queryAll('SELECT * FROM `services` WHERE `order_id` = ?', array($configData['orderID']));
?>
<!doctype html>
<html lang="cs">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?= $content['meta_title'] ?></title>
  <meta name="description" content="<?= $content['meta_description']?>">
  <meta name="keywords" content="<?= $content['meta_keywords']?>">

  	<!-- For Facebook -->
	<meta property="og:title" content="<?= $content['og_title']?>" /> <!-- max. 88 characters-->
	<meta property="og:type" content="<?= $content['og_description']?>" /> 
	<meta property="og:image" content="assets/facebook_og.png">
	<meta property="og:url" content="https://<?= $content['domain']?>" />
	<meta property="og:description" content="Začněte s levným webem a navyšujte dle potřeby!" /> <!-- around 200 characters-->
	<meta property="og:locale" content="cs_CZ" />

	<link rel="canonical" href="https://<?= $content['domain']?>" />

  <!-- font awesome 6 free -->
  <script src="https://kit.fontawesome.com/a4fa5c84b6.js" crossorigin="anonymous"></script>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">

  <!-- Font font from Google -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/app.css">

  
</head>
<!-- Google tag (gtag.js) -->
<?= $content['g_analytics'] ?>
<!-- End Google tag (gtag.js) -->
<body>
  <!--Hero ====================================== -->
  <header class="container-fluid" id="hero">
    <div class="sticky-wrapper">
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand" href="/"><?= $content['c_brand'] ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
          <div id="navbar-toggler-icon">
            <i class="fas fa-bars"></i>
          </div>         
        </button>
        <div class="collapse navbar-collapse justify-content-between gap-3" id="navbarScroll">
          <ul class="navbar-nav my-2 my-lg-0 ps-lg-5 gap-3">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#hero">Úvod</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#product">Služby</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#aboutus">O nás</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#pricing">Ceník</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#faq">FAQ</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#contact-us">Kontakt</a>
            </li>
          </ul>
          <div class="navbar-social-icons d-flex gap-3 flex-column flex-xl-row justify-content-center align-items-center">
            <ul class="d-flex list-unstyled m-0 p-0 order-lg-1 d-none">
              <?php if(!empty($content['c_facebook'])) : ?>
                <li class="mx-2">
              <a href="<?=$content['c_facebook']?>" class="block-44__link m-0">
                <i class="fab fa-facebook"></i>
              </a>
            </li>
            <?php endif; ?>
            <?php if(!empty($content['c_twitter'])) : ?>
            <li class="mx-2">
              <a href="<?= $content['c_twitter'] ?>" class="block-44__link m-0">
                <i class="fab fa-twitter"></i>
              </a>
            </li>
            <?php endif; ?>
            <?php if(!empty($content['c_instagram'])) : ?>
            <li class="mx-2">
              <a href="<?= $content['c_instagram'] ?>" class="block-44__link m-0">
                <i class="fab fa-instagram"></i>
              </a>
            </li>
            <?php endif; ?>
            <?php if(!empty($content['c_youtube'])) : ?>
            <li class="mx-2">
              <a href="<?= $content['c_youtube'] ?>" class="block-44__link m-0">
                <i class="fab fa-youtube"></i>
              </a>
            </li>
            <?php endif; ?>
            <?php if(!empty($content['c_discord'])) : ?>
            <li class="mx-2">
              <a href="<?= $content['c_discord'] ?>" class="block-44__link m-0">
                <i class="fab fa-discord"></i>
              </a>
            </li>
            <?php endif; ?>
            <?php if(!empty($content['c_linkedin'])) : ?>
            <li class="mx-2">
              <a href="<?= $content['c_linkedin'] ?>" class="block-44__link m-0">
                <i class="fab fa-linkedin"></i>
              </a>
            </li>
            <?php endif; ?>
            <?php if(!empty($content['c_mastodon'])) : ?>
            <li class="mx-2">
              <a href="<?= $content['c_mastodon'] ?>" class="block-44__link m-0">
                <i class="fab fa-mastodon"></i>
              </a>
            </li>
            <?php endif; ?>
          </ul>
          </div>
        </div>
        <?php if($content['c_phone']) : ?>
        <div class="navbar-part2 d-none d-lg-block">
          <i class="fas fa-phone-volume"></i>
          <?= $content['c_phone'] ?>
        </div>
          <?php endif; ?>
      </div>
    </nav>  
    </div> 

  </header>
<div class="hero">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-xl-8 d-flex flex-column align-items-center justify-content-center text-center gap-3">
      
        <h1>
          <?= $content['hero_title']?>
        </h1>
        
        <p>
        <?= $content['hero_subtitle']?>
        </p>
        <p class="align-self-center">
          <?= Utils::buttonCTA($configData['orderID'], $content['web_target']) ?>
        </p>
        
      </div>
    </div>
    
  </div>
</div>
  <!-- ===================================== -->
  <section id="product">
  <div class="container overflow-hidden">
  <div class="row d-flex justify-content-center pb-5 g-5">
    <div class="col-lg-8 d-flex flex-column justify-content-center align-items-center text-center">
      
        <h2><?= $content['feat_headline'] ?></h2>
        <p class="subheadline text-center">
          <?= $content['feat_subheadline'] ?>
        </p>
      
      <div class="col-12 align-self-center">
        <div>
        </div>
      </div>
    </div>
  </div>
  <div class="row g-5">
      <!-- Feature -->
      <?php $i = 1; foreach($features as $f)  : ?>
        
      <div class="col-md-6 col-xl-3 position-relative">
        <div class="d-flex flex-column gap-1 h-100 rounded-4 p-3 product-card">
          <div class="text-center d-flex flex-column gap-5 justify-content-center align-items-center">
            <div class="icon">
              <span><?= $i ?></span>
            </div>
            <h3><?= $f['f_title'] ?></h3>
          </div>            
          <div>
            <p class="text-center">
            <?= $f['f_content'] ?>
            </p>
          </div>
        </div>     
        <div class="shadow"></div>     
      </div>
      <?php $i ++; ?>
      <?php endforeach ; ?>

    </div>
      <div class="d-flex justify-content-center py-5">
          <?= Utils::buttonCTA($configData['orderID'], $content['web_target']) ?>
      </div>
  </div>
</section>

<section id="aboutus">
    <div class="container overflow-hidden">
      <div class="row gx-5">
      <!-- HEADER -->
      <div class="col-md-4 col-lg-6 order-2">
                <!-- IMAGE -->
        <div class="d-flex justify-content-center h-100 p-lg-5">
          
            <img src="https://www.stanislav-drako.cz/public/img/taxi-about.webp" alt="obrázek o nás" class="img-fluid">
          
        </div>
      </div>
      <div class="col-md-8 col-lg-6 d-flex flex-column justify-content-center align-items-start gap-3 order-1">
        <div class="d-flex flex-column">
          <h2><?= $content['about_title'] ?></h2>          
          <p class="subheadline"><?= $content['about_subtitle'] ?></p>
        </div>
        <p>
            <?= $content['about_content'] ?>
        </p>
        <?php if($content['c_phone']) :?>
        <div class="col-12">
          <hr>
          <div class="pt-3">
            <div class="about-info">
              <i class="fas fa-phone-volume"></i>              
              <span class="fs-3"><?= $content['c_phone'] ?></span>
            </div>
          </div>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>


  <!-- ===================================== -->
  <section id="pricing">
    <div class="container pb-5 overflow-hidden">
    
      <div class="row text-center justify-content-center">
        <div class="col-lg-8 align-self-center">
          <div class="text-center headline">
            <h2><?= $content['price_headline'] ?></h2>
            <p class="subheadline">
              <?= $content['price_subheadline'] ?>
            </p>
          </div>
        </div>
      </div>
      <div class="row justify-content-center pt-5 g-5">

      <?php foreach($services as $s) : ?>
          <div class="col-xl-4 col-md-6">
            <div class="d-flex flex-column justify-content-between gap-2 h-100 price-card p-lg-5 p-4 rounded-4">
             
              <div class=" d-flex justify-content-between align-items-start flex-column">
                <h3><?= $s['services_title']?></h3>
                 <p>
                   <?= $s['services_content']?>
                 </p> 
                </div>
                <p class="pt-3">
                </p>
                <div class="align-self-center pb-3">
                  <span class="price"><?= $s['services_price']?></span>
                </div>
              </div>
                         
          </div>
        <?php endforeach; ?>

      </div>
    </div>
  </section>

  <section id="cta">
  <div class="container-fluid overflow-hidden">
    <div class="row justify-content-center g-5">
      <div class="col-12 col-lg-8">
        <div class="row g-3">
          <div class="col-xl-8 p-lg-4 px-2">
            <h2 class="text-center text-lg-start"><?= $content['cta_title'] ?></h2>
            <p class="text-center text-lg-start"><?= $content['cta_subtitle'] ?></p>
          </div>
          <div class="col-xl-4">
            <div class="d-flex align-items-center justify-content-center h-100">
              <p><?= Utils::buttonCTA($configData['orderID'], $content['web_target']) ?></p>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</section>

  <!-- =================================== -->
<section id="faq">
    <div class="container overflow-hidden">
      <div class="row">
      <!-- HEADER -->
      <div class="d-flex flex-column align-items-center text-center">
        <div class="text-center">
          <h2><?= $content['faq_headline'] ?></h2>
          <p class="subheadline">
            <?= $content['faq_subheadline'] ?>
          </p>
        </div>
      </div>
      </div>
      <div class="row justify-content-center pt-5">
        <div class="col-lg-8 pb-5">
          <div class="d-flex align-items-start h-100">
          <div class="accordion accordion-flush w-100" id="accordionExample">
                <?php foreach($faqs as $faq) : ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading<?= $faq['id'] ?>">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq<?= $faq['id'] ?>" aria-expanded="false" aria-controls="faq<?= $faq['id'] ?>">                                                        
                        <?= $faq['faq_question'] ?>  
                    </h2>
                    <div id="faq<?= $faq['id'] ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $faq['id'] ?>" data-bs-parent="#accordionExample">
                        <div class="accordion-body d-flex card-1__paragraph">
                        <?= $faq['faq_answer'] ?>
                        
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
      
    </div>
</section>

<section id="contact-us">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center py-5">
        
          <h2><?= $content['contact_headline'] ?></h2>
          <p class="subheadline px-5">
              <?= $content['contact_subheadline'] ?>
            </p>
        
      </div>
      <div class="col-lg-4 col-md-6 px-3 ">
        <h6 class="fw-bold fs-5 pb-2"><?= $content['c_person'] ?></h6>
        <p class="d-flex flex-column gap-3">
          <span><?= $content['c_address'] ?></span>
          <?php if(!empty($content['c_ico'])) : ?>
          <span><?= 'IČO: ' . $content['c_ico'] ?></span>
          <?php endif; ?>
          <?php if(!empty($content['c_dic'])) : ?>
          <span><?= 'DIČ: ' . $content['c_dic'] ?></span>
          <?php endif; ?>
          <?php if(!empty($content['c_datovka'])) : ?>
          <span><?= 'Datová schránka: ' . $content['c_datovka'] ?></span>
          <?php endif; ?>
        </p>
      </div>

      <div class="col-lg-4 col-md-6 px-3 px-xl-5 py-5 py-lg-0">          
        <p class="d-flex flex-column gap-3">
          <?php if(!empty($content['c_phone'])) : ?>
          <span>
            <a href="tel:<?= $content['c_phone'] ?>"><i class="fas fa-phone"></i><span class="mx-2"><?= $content['c_phone'] ?></span></a>
          </span>
          <?php endif; ?>
          <?php if(!empty($content['c_email'])) : ?>
          <span>
            <a href="mailto:<?= $content['c_email'] ?>"><i class="fas fa-envelope"></i><span class="mx-2"><?= $content['c_email'] ?></span></a>
          </span>
          <?php endif; ?>
        </p>
      </div>
        
      <?php if(!$content['nonstop']) :  ?> 
          
      <div class="col-12 col-md-6 col-lg-4 d-flex flex-column justify-content-center gap-3 px-3">                          
        <div class="d-flex justify-content-between">
            <span class="headline-color">Pondělí: </span>
            <?php if($content['mon_hour_start']) : ?>
            <div class="d-flex gap-2">
                <div><span><?= $content['mon_hour_start'] ?></span> : <span><?= $content['mon_min_start'] ?></span></div>
                <div> - <span><?= $content['mon_hour_end'] ?></span> : <span><?= $content['mon_min_end'] ?></span></div>
            </div>
            <?php else : ?>
              <div><span class="text-danger">Zavřeno</span></div>
            <?php endif; ?>
        </div> 
        <div class="d-flex justify-content-between">
            <span class="headline-color">Úterý: </span>
            <?php if($content['tue_hour_start']) : ?>
            <div class="d-flex gap-2">
                <div><span><?= $content['tue_hour_start'] ?></span> : <span><?= $content['tue_min_start'] ?></span></div>
                <div> - <span><?= $content['tue_hour_end'] ?></span> : <span><?= $content['tue_min_end'] ?></span></div>
            </div>
            <?php else : ?>
              <div><span class="text-danger">Zavřeno</span></div>
            <?php endif; ?>
        </div>
        <div class="d-flex justify-content-between">
            <span class="headline-color">Středa: </span>
            <?php if($content['wen_hour_start']) : ?>
            <div class="d-flex gap-2">
                <div><span><?= $content['wen_hour_start'] ?></span> : <span><?= $content['wen_min_start'] ?></span></div>
                <div> - <span><?= $content['wen_hour_end'] ?></span> : <span><?= $content['wen_min_end'] ?></span></div>
            </div>
            <?php else : ?>
              <div><span class="text-danger">Zavřeno</span></div>
            <?php endif; ?>
        </div>     
        <div class="d-flex justify-content-between">
            <span class="headline-color">Čtvrtek: </span>
            <?php if($content['thu_hour_start']) : ?>
            <div class="d-flex gap-2">
                <div><span><?= $content['thu_hour_start'] ?></span> : <span><?= $content['thu_min_start'] ?></span></div>
                <div> - <span><?= $content['thu_hour_end'] ?></span> : <span><?= $content['thu_min_end'] ?></span></div>
            </div>
            <?php else : ?>
              <div><span class="text-danger">Zavřeno</span></div>
            <?php endif; ?>
        </div>
        <div class="d-flex justify-content-between">
            <span class="headline-color">Pátek: </span>
            <?php if($content['fri_hour_start']) : ?>
            <div class="d-flex gap-2">
                <div><span><?= $content['fri_hour_start'] ?></span> : <span><?= $content['fri_min_start'] ?></span></div>
                <div> - <span><?= $content['fri_hour_end'] ?></span> : <span><?= $content['fri_min_end'] ?></span></div>
            </div>
            <?php else : ?>
              <div><span class="text-danger">Zavřeno</span></div>
            <?php endif; ?>
        </div> 
        <div class="d-flex justify-content-between">
            <span class="headline-color">Sobota: </span>
            <?php if($content['sat_hour_start']) : ?>
            <div class="d-flex gap-2">
                <div><span><?= $content['sat_hour_start'] ?></span> : <span><?= $content['sat_min_start'] ?></span></div>
                <div> - <span><?= $content['sat_hour_end'] ?></span> : <span><?= $content['sat_min_end'] ?></span></div>
            </div>
            <?php else : ?>
              <div><span class="text-danger">Zavřeno</span></div>
            <?php endif; ?>
        </div>                                                                     
        <div class="d-flex justify-content-between">
            <span class="headline-color">Neděle: </span>
            <?php if($content['sun_hour_start']) : ?>
            <div class="d-flex gap-2">
                <div><span><?= $content['sun_hour_start'] ?></span> : <span><?= $content['sun_min_start'] ?></span></div>
                <div> - <span><?= $content['sun_hour_end'] ?></span> : <span><?= $content['sun_min_end'] ?></span></div>
            </div>
            <?php else : ?>
              <div><span class="text-danger">Zavřeno</span></div>
            <?php endif; ?>
        </div> 
      </div>
  
      <?php endif; ?>
      
      <div class="col-12 footer">
        
        <div class="container">
          <div class="row flex-column flex-lg-row pt-3 justify-content-center">
            <div class="col-12 col-md-4 px-0">
              <ul class="d-flex list-unstyled ">
                <?php if(!empty($content['c_facebook'])) : ?>
                  <li class="mx-2">
                  <a href="<?=$content['c_facebook']?>">
                    <i class="fab fa-facebook"></i>
                  </a>
                </li>
                <?php endif; ?>
                <?php if(!empty($content['c_twitter'])) : ?>
                <li class="mx-2">
                  <a href="<?= $content['c_twitter'] ?>">
                    <i class="fab fa-twitter"></i>
                  </a>
                </li>
                <?php endif; ?>
                <?php if(!empty($content['c_instagram'])) : ?>
                <li class="mx-2">
                  <a href="<?= $content['c_instagram'] ?>" >
                    <i class="fab fa-instagram"></i>
                  </a>
                </li>
                <?php endif; ?>
                <?php if(!empty($content['c_youtube'])) : ?>
                <li class="mx-2">
                  <a href="<?= $content['c_youtube'] ?>" >
                    <i class="fab fa-youtube"></i>
                  </a>
                </li>
                <?php endif; ?>
                <?php if(!empty($content['c_discord'])) : ?>
                <li class="mx-2">
                  <a href="<?= $content['c_discord'] ?>" >
                    <i class="fab fa-discord"></i>
                  </a>
                </li>
                <?php endif; ?>
                <?php if(!empty($content['c_linkedin'])) : ?>
                <li class="mx-2">
                  <a href="<?= $content['c_linkedin'] ?>" >
                    <i class="fab fa-linkedin"></i>
                  </a>
                </li>
                <?php endif; ?>
                <?php if(!empty($content['c_mastodon'])) : ?>
                <li class="mx-2">
                  <a href="<?= $content['c_mastodon'] ?>" >
                    <i class="fab fa-mastodon"></i>
                  </a>
                </li>
                <?php endif; ?>
              </ul>
              
            </div>
            <div class="col-md-8">
              <p class="block-41__copyrights">&copyCopyright 2022 - <?= date('Y')?>. Vytvořil s láskou <a href="https://www.stanislav-drako.cz">Stanislav Drako</a></p>
            </div>
            
          
        </div>
      </div>
      </div>
    </div>
  </div>
</div>

</section>

  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/jquery-3.6.3.min.js"></script>

  <script src="assets/js/app.js"></script>


</body>

</html>
