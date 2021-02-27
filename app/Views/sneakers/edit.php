<!-- file edit sneakers -->

<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="my-3">Form Edit List of Sneakers</h2>

            <form action="/sneakers/update/<?= $sneakers['id']; ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="slug" value="<?= $sneakers['slug']; ?>">
                <input type="hidden" name="oldPicture" value="<?= $sneakers['picture']; ?>">
                <div class="row mb-3">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('name')) ? 'is-invalid' : ''; ?>" id="name" name="name" autofocus value="<?= (old('name')) ? old('name') : $sneakers['name'] ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('name'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="brand" class="col-sm-2 col-form-label">Brand</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('brand')) ? 'is-invalid' : ''; ?>" id="brand" name="brand" value="<?= (old('brand')) ? old('brand') : $sneakers['brand'] ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('brand'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="price" class="col-sm-2 col-form-label">Price</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control <?= ($validation->hasError('price')) ? 'is-invalid' : ''; ?>" id="price" name="price" value="<?= (old('price')) ? old('price') : $sneakers['price'] ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('price'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="picture" class="col-sm-2 col-form-label">Picture</label>
                    <div class="col-sm-2">
                        <img src="/img/<?= $sneakers['picture']; ?>" class="img-thumbnail img-preview">
                    </div>
                    <div class="col-sm-8">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input <?= ($validation->hasError('picture')) ? 'is-invalid' : ''; ?>" id="picture" name="picture" onchange="previewImg">
                            <label class="custom-file-label" for="picture"><?= $sneakers['picture']; ?></label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Edit</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>