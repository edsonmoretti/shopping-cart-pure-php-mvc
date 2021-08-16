<?php /* @var $product \App\Models\Product */
$product = new \App\Models\Product();
if ($id = filter_input(INPUT_GET, 'id')) {
    $product = \App\Models\Product::findById($id);
} ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Produto</h1>
    <p class="mb-4">Cadastro de produtos da loja.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <?php if ($errorCode = filter_input(INPUT_GET, 'error')) { ?>
            <div class="alert alert-danger"><?= error($errorCode) ?></div>
        <?php } ?>
        <?php if ($message = filter_input(INPUT_GET, 'success')) { ?>
            <div class="alert alert-success"><?= $message ?></div>
        <?php } ?>
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Cadastro de Produto</h6>
        </div>
        <div class="card-body">
            <form class="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="action" value="save-product">
                <input type="hidden" name="id" value="<?= $product->getId() ?>">
                <div class="form-group">
                    <input type="text" required class="form-control form-control" id="name" name="name"
                           placeholder="Nome do Produto" value="<?= $product->getName() ?>">
                </div>
                <div class="form-group">
                    <input type="text" required class="form-control form-control" id="gtin" name="gtin"
                           placeholder="GTIN/EAN13" value="<?= $product->getGtin() ?>">
                </div>
                <div class="form-group">
                    <input type="text" required class="form-control form-control" id="description" name="description"
                           placeholder="Descrição do produto" value="<?= $product->getDescription() ?>">
                </div>

                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="file" <?= $product->getId() ? '' : 'required' ?> class="form-control
                        form-control" id="price"
                               name="image" accept="image/png, image/gif, image/jpeg"
                               placeholder="Imagem">
                    </div>
                    <div class="col-sm-6 " style="text-align: center">

                        <img src="<?= $product->getImage() ?>" width="250" class="img-fluid"/>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="text" required class="form-control
                        form-control" id="price"
                               name="price"
                               value="<?= $product->getPrice() ?>"
                               placeholder="Valor de venda">
                    </div>
                    <div class="col-sm-6">
                        <input type="text" required class="form-control
                        form-control" id="stock_quantity"
                               name="stock_quantity"
                               value="<?= $product->getStockQuantity() ?>"
                               placeholder="Quantidade em estoque">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn btn-block">
                    Salvar
                </button>
            </form>
        </div>
    </div>
</div>