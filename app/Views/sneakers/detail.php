<!-- file detail sneakers -->

<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class='mt-2'>Detail Sneakers</h2>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="/img/<?= $sneakers['picture']; ?>" class="card-img" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $sneakers['name']; ?></h5>
                            <p class="card-text"><?= $sneakers['brand']; ?></p>
                            <p class="card-text"><?= $sneakers['price']; ?></p>

                            <a href="/sneakers/edit/<?= $sneakers['slug']; ?>" class="btn btn-warning">Edit</a>
                            <form action="/sneakers/<?= $sneakers['id']; ?>" method="post" class="d-inline"><?= csrf_field(); ?> <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure want to delete this data?');">Delete</button>
                            </form>
                            <br><br>
                            <a href="/sneakers">Back to the list of sneakers</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>