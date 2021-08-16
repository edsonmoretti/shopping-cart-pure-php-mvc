<?php /* @var $user \App\Models\User */
$user = new \App\Models\User();
if ($id = filter_input(INPUT_GET, 'id')) {
    $user = \App\Models\User::findById($id);
} ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Usuários</h1>
    <p class="mb-4">Cadastro de usuários do sistema.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <?php if ($errorCode = filter_input(INPUT_GET, 'error')) { ?>
            <div class="alert alert-danger"><?= error($errorCode) ?></div>
        <?php } ?>
        <?php if ($message = filter_input(INPUT_GET, 'success')) { ?>
            <div class="alert alert-success"><?= $message ?></div>
        <?php } ?>
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Cadastro de usuário</h6>
        </div>
        <div class="card-body">
            <form class="user" method="post"
                  oninput='
                     password2.setCustomValidity(password.value != password2.value ? "Senhas não conferem" : "");
                     cpf.setCustomValidity(validarCPF(cpf.value)?"":"CPF Inválido");
                    '>
                <input type="hidden" name="action" value="save-user">
                <input type="hidden" name="id" value="<?= $user->getId() ?>">
                <div class="form-group">
                    <input type="text" required class="form-control form-control-user" id="name" name="name"
                           placeholder="Nome completo" value="<?= $user->getName() ?>">
                </div>
                <div class="form-group">
                    <input type="text" required class="form-control form-control-user" id="cpf" name="cpf"
                           placeholder="Número do CPF" value="<?= $user->getCpf() ?>">
                </div>
                <div class="form-group">
                    <input type="date" required class="form-control form-control-user" id="birthday" name="birthday"
                           placeholder="Data de Nascimento"
                           value="<?= $user->getBirthday() ? $user->getBirthday()->format('Y-m-d') : '' ?>">
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="password" <?= $user->getId() ? '' : 'required' ?> class="form-control
                        form-control-user" id="password"
                        name="password" value=""
                        placeholder="Senha">
                    </div>
                    <div class="col-sm-6">
                        <input type="password" <?= $user->getId() ? '' : 'required' ?> class="form-control
                        form-control-user" id="password2"
                        name="password2"
                        placeholder="Repita a senha">
                    </div>
                </div>
                <?php if ($user->getId()) { ?>
                    <div class="alert alert-info">Deixe as senhas em branco se não quiser alterar.</div>
                <?php } ?>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    Salvar
                </button>
            </form>
        </div>
    </div>
</div>