<!-- file index sneakers -->

<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="mt-2">List Of Sneakers</h1>
            <a href="/sneakers/create" class="btn btn-primary mb-3">Create</a>
            <?php if (session()->getFlashdata('message')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('message'); ?>
                </div>
            <?php endif;  ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Picture</th>
                        <th scope="col">Name</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Price</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($sneakers as $s) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><img src="/img/<?= $s['picture']; ?>" alt="" class="size"></td>
                            <td> <?= $s['name']; ?></td>
                            <td> <?= $s['brand']; ?></td>
                            <td> <?= $s['price']; ?></td>
                            <td>
                                <a href="/sneakers/<?= $s['slug']; ?>" class="btn btn-success">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach  ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>