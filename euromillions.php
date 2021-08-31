<?php

use Provider\EuroMillionProvider;

require __DIR__ . '/Provider/EuroMillionProvider.php';

//SEO
$seo['title'] = "Derniers Résultats EuroMillions";
$seo['meta_description'] = "";
//Include Header Page
include ('header.php');
//Define URL FDJ to scrap
$urlhn = "https://www.fdj.fr/jeux/jeux-de-tirage/euromillions/resultats";

$provider = new EuroMillionProvider();
$euromillion = $provider->getData();

?>

<main role="main">
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading text-uppercase">Derniers Résultats EuroMillions</h1>
                <p><i class="fa fa-calendar"></i> <?= $euromillion->getDate()->format('d/m/Y') ?>  </p>

                <p>
                    <?php foreach ($euromillion->getNumbers() as $number): ?>
                        <span class="btn btn-lg btn-dark rounded"><?= $number; ?></span>
                    <?php endforeach; ?>
                    <?php foreach ($euromillion->getStars() as $star): ?>
                         <span class="btn btn-lg btn-warning rounded"><?= $star; ?></span>
                    <?php endforeach; ?>
                </p>

                <h3><small><i class="fa fa-trophy"></i> MY MYLLION</small></h3>
                <h3><span class="badge badge-dark"><?= $euromillion->getMyMillion(); ?></span></h3>
        </div>
    </section>

    <div class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card mb-4 box-shadow">
                        <div class="card-header bg-primary text-white text-uppercase">
                            Résultats EuroMillions
                        </div>
                        <div class="card-body">
                            <?php if(true): ?>
                                <div class="table-responsive table-striped table-hover">
                                    <table class="table" cellspacing="0">
                                        <?=
                                        str_replace(
                                            array(
                                                '<span class="etoile fl sprite-jeux-form_combien_etoile">&nbsp;</span>',
                                                '<span class="etoile sprite-jeux-form_combien_etoile">&nbsp;</span>'
                                            ),
                                            array(
                                                '<i class="fa fa-star"></i> ',
                                                '<i class="fa fa-star"></i> '
                                            ),
                                            $euromillion->getWinnerTable()
                                        ); ?>
                                    </table>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include ('footer.php'); ?>
