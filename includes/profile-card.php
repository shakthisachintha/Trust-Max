<?php

$sponid = $userdetail['user_sponserid'];
$detail = $db->singlerec("select * from mlm_register where user_profileid='$sponid' and user_status='0'");

?>

<div class="p-2 pb-4 shadow-sm bg-white">
    <div class="pt-4 text-dark text-center">
        <img id="prof-img" class="rounded-circle p-1 shadow-sm img-fluid img-center" style="width:11rem;height:11rem" src="<?= $profileimages ?>" alt="Profile Image">
        <h5 class="mt-3 text-dark font-weight-600"><?= ucwords($userdetail['user_fname'] . " " . $userdetail['user_lname']) ?></h5>
        <p title="Profile ID"><?= $userdetail['user_profileid'] ?></p>
        <hr width="90%">
        <div style="font-size:0.9rem;" class="text-left font-weight-bold pl-3 pr-3">
            <div class="row mt-2">
                <div class="col-4 text-muted"> <i class="fa fa-envelope" aria-hidden="true"></i> &nbsp; Email</div>
                <div class="col-8 text-right text-truncate" title="<?= $userdetail['user_email'] ?>"><?= $userdetail['user_email'] ?></div>
            </div>
            <div class="row mt-2">
                <div class="col-4 text-muted"> <i class="fa fa-star" aria-hidden="true"></i> &nbsp; Sponser</div>
                <div class="col-8 text-right text-truncate" title="<?= ucwords($detail['user_fname'] . ' ' . $detail['user_lname']); ?>"><?= ucwords($detail['user_fname'] . ' ' . $detail['user_lname']); ?></div>
            </div>
            <div class="row mt-2">
                <div class="col-4 text-muted"> <i class="fa fa-sticky-note" aria-hidden="true"></i> &nbsp; Policy</div>
                <div class="col-8 text-right text-truncate" title="<?= ucfirst($userdetail['policy']) ?>">
                    <?= ucfirst($userdetail['policy']) ?>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-4 text-muted"> <i class="fa fa-money" aria-hidden="true"></i> &nbsp; Amount</div>
                <div class="col-8 text-right text-truncate" title="<?= $userdetail['ammount'] ?>">
                    <?= $userdetail['ammount'] ?>
                </div>
            </div>
            <?php $created = new DateTime($userdetail['user_date']) ?>

            <div class="row mt-2">
                <div class="col-4 text-muted"> <i class="fa fa-calendar" aria-hidden="true"></i> &nbsp; Joined On</div>
                <div class="col-8 text-right text-truncate" title="<?= $created->format('Y-m-d') ?>">
                    <?= $created->format('Y-m-d') ?>
                </div>
            </div>
        </div>
    </div>
</div>