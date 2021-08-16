<?php

namespace App;

use App\Models\Product;
use App\Models\User;

class App
{

    private static App $instance;
    public string $pageDir;

    /**
     * App constructor.
     */
    private function __construct()
    {
        $this->pageDir = 'views/';
    }

    /**
     * @return App
     */
    public static function getInstance(): App
    {
        if (!isset(self::$instance)) {
            self::$instance = new App();
        }
        return self::$instance;
    }


    public function render($page = null, array $parameters = null)
    {
        $page = $this->checkPage($page);
        ob_start();
        include_once 'layout/template.php';
        $html = ob_get_contents();
        ob_end_clean();

        $content = $this->getPageContent($page, $parameters);

        $html = str_replace('{{ content }}', $content, $html);
        echo $html;
    }

    private function getPageContent($page, $parameters = null)
    {
        $file = $this->pageDir . $page;
        if (!file_exists($file)) {
            $file = $this->pageDir . 'error.php';
        }
        $urlParameters = is_null($parameters) ? '' : http_build_query($parameters);
        //$url = url($file . (!empty($urlParameters) ? ('?' . $urlParameters) : ''));
        $fileContent = file_get_contents($file, true);
        ob_start();
        eval("?>$fileContent");
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }


    public function checkSession(): bool
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        return isset($_SESSION[SESSION_NAME]);
    }

    public function setSession($user)
    {
        $_SESSION[SESSION_NAME] = serialize($user);
    }

    public function unsetSession()
    {
        unset($_SESSION[SESSION_NAME]);
    }

    public function post(array $request)
    {
        if (isset($request['action'])) {
            switch ($request['action']) {
                case 'login':
                    $this->checkSession();
                    $this->unsetSession();
                    $cpf = $request['cpf'];
                    $password = $request['password'];
                    $user = new User();
                    $user->setCpf($cpf);
                    $user->setPassword(md5(md5($password)));
                    if ($user = User::check($user)) {
                        $this->setSession($user);
                        header('Location: ' . url(''));
                    } else {
                        header('Location: ?error=0');
                    }

                    break;
                case 'logout':
                    $this->checkSession();
                    $this->unsetSession();
                    session_destroy();
                    header('Location: ' . url(''));
                    break;
                case 'save-user':
                    $user = User::findById($request['id']);
                    if ($user) {
                        if (!empty($request['password'])) {
                            $user->setPassword(md5(md5($request['password'])));
                        }
                    } else {
                        $user = new User();
                        $user->setPassword(md5(md5($request['password'])));
                    }
                    $user->setCpf($request['cpf']);
                    $user->setName($request['name']);
                    $user->setBirthday($request['birthday']);
                    $result = $user->save();
                    if (isset($result['error'])) {
                        header('Location: ?p=save-user&error=' . $result['error']);
                    } else if ($result) {
                        header('Location: ?p=save-user&id=' . $user->getId() . '&success=Salvo com sucesso!');
                    } else {
                        header('Location: ?p=save-user&error=Não foi possível salvar o usuário.');
                    }
                    break;
                case 'delete-user':
                    if (App::getInstance()->getLoggedUser()->getId() === $request['id']) {
                        header('Location: ?p=users&error=7');
                        return;
                    }
                    $user = User::findById($request['id']);
                    if (!$user) {
                        header('Location: ?p=users&error=9');
                    }
                    if ($user->destroy()) {
                        header('Location: ?p=users&success=Usuário ' . $user->getName() . ' apagado com sucesso!');
                    } else {
                        header('Location: ?p=users&error=Não foi possível remover o usuário ' . $user->getName());
                    }
                    break;
                case 'save-product':
                    /* @var $product Product */
                    $product = Product::findById($request['id']);
                    if ($product) {
                    } else {
                        $product = new Product();
                    }
                    $product->setDescription($request['description']);
                    $product->setName($request['name']);
                    $product->setGtin($request['gtin']);
                    $product->setPrice($request['price']);
                    $product->setStockQuantity($request['stock_quantity']);

                    if (!file_exists('../uploads/'))
                        mkdir('../uploads/');
                    if ($_FILES['image']['size']) {
                        $image = $_FILES['image']['name'];
                        $expImage = explode('.', $image);
                        $imageExpType = $expImage[1];
                        $imageName = md5($product->getId()) . '.' . $imageExpType;
                        $imagePath = "../uploads/" . $imageName;
                        move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);
                        $product->setImage($imagePath);
                    }
                    $result = $product->save();
                    if (isset($result['error'])) {
                        header('Location: ?p=save-product&error=' . $result['error']);
                    } else if ($result) {
                        header('Location: ?p=save-product&id=' . $product->getId() . '&success=Salvo com sucesso!');
                    } else {
                        header('Location: ?p=save-product&error=Não foi possível salvar o usuário.');
                    }
                    break;
                default:
                    break;
            }
        }
    }

    public function api(array $request)
    {
        /* @var $product Product */
        switch ($request['action']) {
            case 'products':
                $i = 0;
                $return = [];
                foreach (Product::all() as $p) {
                    $return[$i++] = $p->toArray();
                }
                return json_encode($return);
            case 'product':
                $product = Product::findById($request['id']);
                return json_encode($product->toArray());
            case 'cart':
                if (session_status() !== PHP_SESSION_ACTIVE) {
                    session_start();
                }
                if(!isset($_SESSION['lojinha-cart'])){
                    $_SESSION['lojinha-cart'] = serialize([]);
                }
                $products = unserialize($_SESSION['lojinha-cart']);

                if (isset($request['add-id'])) {
                    $product = Product::findById($request['add-id']);
                    if($product){
                        $products[$product->getId()]++;
                        $_SESSION['lojinha-cart'] = serialize($products);
                    }
                    return json_encode(true);
                } else if (isset($request['remove-id'])) {
                    $product = Product::findById($request['remove-id']);
                    if($product){
                        if($products[$product->getId()] > 0){
                            $products[$product->getId()]--;
                            $_SESSION['lojinha-cart'] = serialize($products);
                        }
                    }
                    return json_encode(true);
                }

                if(empty($products)){
                    return  json_encode([
                        'products' => [],
                        'html'=>'<div style="text-align: center;"><strong>Nenhum produto adicionado</strong></div>',
                        'total'=>'0,00'
                    ]);
                }
//                dd($products);
                $total = 0;
                $htmlProdutos = '';
                //TODO: esse for tem q vir da sessao dos produtos
                foreach (unserialize($_SESSION['lojinha-cart']) as $productId => $qtd) {
                    if(!empty($qtd)){
                        $product = Product::findById($productId);
                        $htmlProdutos .= '<div class="row g-3">
                                              <div class="col-sm">
                                                <img  class="img-fluid" width="50" src="' . $product->getImage() . '">
                                              </div>
                                              <div class="col-sm">
                                                '. $qtd .' x R$'. number_format($product->getPrice(), 2, ',', '').' '. $product->getName() . '
                                              </div>
                                              <div class="col-sm">
                                                <strong>R$' . number_format($qtd*$product->getPrice(), 2, ',', '') . '</strong>
                                                <a href="#"
                                                 class="text-danger btn-remove-from-cart" 
                                                 title="Remover um"
                                                 id="' . $product->getId() . '"
                                                  ><i class="bi bi-cart-dash"></i></a>
                                              </div>
                                            </div>
                                                    <hr>';
                        $total += $product->getPrice()*$qtd;
                    }
                }
                $htmlFull = '<div class="popover-body"><div class="row">
                                    <div class="col-xs-8">
                                        <div class="panel panel-info">
                                            <div class="panel-body">
                                                ' . $htmlProdutos . '
                                                <div class="row">
                                                    <div class="text-center">
                                                        <div class="col-xs-3">
                                                            <div class="col-xs-9">
                                                                <h6 class="text-right">Já achou tudo que queria?</h6>
                                                            </div>
                                                            <a class="btn btn-success">
                                                                Finalizar compra
                                                            </a>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel-footer">
                                                <div class="row text-center">
                                                    <div class="col-xs-9">
                                                        <h6 class="text-right">Total <strong>R$' . number_format($total, 2, ',', '') . '</strong></h6>
                                                    </div>
                                                    <div class="col-xs-3">
                                                        <button type="button" class="btn btn-success btn-block">
                                                            Checkout
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                           </div>';
                return json_encode([
                    'products' => $product->toArray(),
                    'html' => $htmlFull,
                    'total' => number_format($total, 2, ',', ''),
                ]);
        }
    }

    public function getLoggedUser(): ?User
    {
        if ($this->checkSession()) {
            try {
                return \user();
            } catch (\Exception $err) {
            }
        }
        return null;
    }

    private function checkPage($page)
    {
        //TODO: tratar se o arquivo não exisir?
        if (empty($page))
            $page = 'home.php';

        if (endsWith('.php', $page)) {
        } else if (endsWith('.html', $page)) {
            //TODO: tratar isso?
        } else {
            $page = $page . '.php';
        }
        return $page;
    }
}