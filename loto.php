<?php

use Provider\LotoProvider;

require __DIR__ . '/Provider/LotoProvider.php';

//SEO
$seo['title'] = "Derniers Résultats du Loto";
$seo['meta_description'] = "";
//Include Header Page
include ('header.php');

$provider = new LotoProvider();
$loto = $provider->getData();

?>

<main role="main">
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading text-uppercase">Derniers Résultats du Loto</h1>
                <p><i class="fa fa-calendar"></i> <?= $loto->getDate()->format('d/m/Y'); ?>  </p>

                <p>
                    <?php foreach ($loto->getNumbers() as $number): ?>
                        <span class="btn btn-lg btn-dark rounded"><?= $number; ?></span>
                    <?php endforeach; ?>
                    <?php foreach ($loto->getLuckyNumbers() as $luckyNumber): ?>
                        <span class="btn btn-lg btn-warning rounded"><?= $luckyNumber; ?></span>
                    <?php endforeach; ?>
                </p>

                <h3><small><i class="fa fa-trophy"></i> JOCKER +</small></h3>
                <h3><span class="badge badge-dark"><?= $loto->getJocker(); ?></span></h3>
        </div>
    </section>

    <div class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card mb-4 box-shadow">
                        <div class="card-header bg-primary text-white text-uppercase">
                            Résultats du Loto
                        </div>
                        <div class="card-body">
                            <?php if(true): ?>
                                <div class="table-responsive table-striped table-hover">
                                    <table class="table" cellspacing="0">
                                        <?= $loto->getWinnerTable() ?>
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
