<?php
function url($value)
{
    return URL . $value;
}

function endsWith($value, $where)
{
    $len = strlen($value);
    if ($len === 0) {
        return true;
    }
    return (substr($where, -$len) === $value);
}

function dd($var = null)
{
    var_dump($var);
    die();
}

function user(): \App\Models\User
{
    return unserialize($_SESSION[SESSION_NAME]);
}

function error($error)
{
    switch ($error) {
        case 0:
            return 'Dados não conferem';
        case 7:
            return "Você não pode excluir você mesmo!";
        case 8:
            return "CPF já cadastro.";
        case 9:
            return "Usuário não encontrado.";
        default:
            return $error;
    }
}

function view_exists($view)
{
    $viewCompleteName = $_SERVER['DOCUMENT_ROOT'] . '/admin/' . \App\App::getInstance()->pageDir . $view . '.php';
    return file_exists($viewCompleteName);
}