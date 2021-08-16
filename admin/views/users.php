<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Usuários</h1>
    <p class="mb-4">Cadastro de usuários do sistema.</p>

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
                        <th>CPF</th>
                        <th>Aniversário</th>
                        <th>Idade</th>
                        <th>Opções</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Aniversário</th>
                        <th>Idade</th>
                        <th>Opções</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php foreach (\App\Models\User::all() as $user) { ?>
                        <tr>
                            <td><?= $user->getName() ?></td>
                            <td><?= $user->getCpf() ?></td>
                            <td><?= $user->getBirthday()->format('d/m/Y') ?></td>
                            <td><?= $user->getAge() ?></td>
                            <td>
                                <a class="btn btn-circle btn-light" href="?p=save-user&id=<?= $user->getId() ?>">
                                    <li class="fa fa-user-edit text-info"></li>
                                </a>
                                <button class="btn btn-circle btn-light delete-user"
                                       data-id="<?= $user->getId() ?>">
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