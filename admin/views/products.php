<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Produtos</h1>
    <p class="mb-4">Cadastro de produtos da loja.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <?php if ($message = filter_input(INPUT_GET, 'success')) { ?>
            <div class="alert alert-success card">
                <strong><?= $message ?></strong>
            </div>
        <?php } ?>
        <?php if ($errorCode = filter_input(INPUT_GET, 'error')) { ?>
            <div class="alert alert-danger card">
                <strong><?= error($errorCode) ?></strong>
            </div>
        <?php } ?>
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Usuários</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>GTIN/EAN</th>
                        <th>Descrição</th>
                        <th>Valor de venda</th>
                        <th>Quantidade em estoque</th>
                        <th>Opções</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Nome</th>
                        <th>GTIN/EAN</th>
                        <th>Descrição</th>
                        <th>Valor de venda</th>
                        <th>Quantidade em estoque</th>
                        <th>Opções</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php /** @var $product \App\Models\Product * */
                    foreach (\App\Models\Product::all() as $product) { ?>
                        <tr>
                            <td>
                                <div style="text-align: center">
                                    <a href="?p=save-product&id=<?= $product->getId() ?>">
                                        <img src="<?= $product->getImage() ?>" class="img-fluid" width="30"/>
                                        <br>
                                        <?= $product->getName() ?>
                                    </a>
                                </div>
                            </td>
                            <td><?= $product->getGtin() ?></td>
                            <td><?= $product->getDescription() ?></td>
                            <td><?= number_format($product->getPrice(), 2, ',', '') ?></td>
                            <td><?= number_format($product->getStockQuantity(), 2, ',', '') ?></td>
                            <td>
                                <a class="btn btn-circle btn-light" href="?p=save-product&id=<?= $product->getId() ?>">
                                    <li class="fa fa-user-edit text-info"></li>
                                </a>
                                <button class="btn btn-circle btn-light delete-product"
                                        data-id="<?= $product->getId() ?>">
                                    <li class="fa fa-user-times text-danger"></li>
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>