<div class="d-flex justify-content-center align-items-center" style="margin-top:100px; margin-bottom: 400px">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Login no sistema</h6>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <input type="hidden" value="login" name="action"/>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="cpf">CPF</label>
                                    <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Nº. CPF">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="password">Senha</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                           placeholder="Senha">
                                </div>
                            </div>

                            <?php if (isset($_GET['error'])) { ?>
                                <div class="form-row alert alert-danger">
                                    <span><?= error($_GET['error']) ?></span>
                                </div>
                            <?php } ?>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <button type="submit" class="btn btn-primary">Entrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
            </div>
        </div>
    </div>
</div>