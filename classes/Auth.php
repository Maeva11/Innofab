<?php


class Auth extends Controller
{
    protected $table;
    public $db;

    public function __construct()
    {
        parent::__construct();
        $this->table = parent::getModel()->setTable(DB_PREFIX . 'users');
        $this->db = parent::getModel()->getDb();
    }

    public function login($email, $password)
    {
        if (!empty($email) && !empty($password)) {
            $auth = $this->getBy(["email" => $email])[0];
            if (password_verify($password, $auth->password)) {
                $_SESSION['user'] = $auth->id;
                header('location: ' . USER_FILE);
                return true;
            }
            return false;
        }
        return false;
    }

    public function register($datas)
    {
        if (!empty($datas['email']) && !empty($datas['password']) && !empty($datas['passwordRepeat']) && @$datas['password'] == @$datas['passwordRepeat']) {
            $params['nom'] = @$datas['nom'];
            $params['prenom'] = @$datas['prenom'];
            $params['email'] = @$datas['email'];
            $params['password'] = password_hash($datas['password'], PASSWORD_DEFAULT);
            if ($this->set($params)) {
                $this->login($datas['email'], $datas['password']);
            }
            return false;
        }
        return false;
    }

    public function unregister()
    {
        $this->remove($_SESSION['user']);
    }

    public function logout()
    {
        unset($_SESSION['user']);
    }

    public function registerNewsletters()
    {
        $this->set(['id' => $_SESSION['id'], "newsletters" => 1]);
    }

    public function unregisterNewsletters()
    {
        $this->set(['id' => $_SESSION['id'], "newsletters" => 0]);
    }

    public function edit($datas, $params)
    { //variable params qui permet de rajouter des paramètres en plus
        $auth = $this->getBy(["id" => $_SESSION['id']])[0];
        if (!empty($datas['NewPassword']) && !empty($datas['NewPasswordRepeat'])) {
            if (password_verify(@$datas['password'], $auth->password)) {
                if ($datas['NewPassword'] == $datas['NewPasswordRepeat']) {
                    $params['password'] = password_hash($datas['NewPassword'], PASSWORD_DEFAULT);
                }
            }
        }
        $params['id'] = $_SESSION['id']
        (!empty($datas['nom'])) ? $params['nom'] = $datas['nom'] : "";
        (!empty($datas['prenom'])) ? $params['prenom'] = $datas['prenom'] : "";
        (!empty($datas['email'])) ? $params['email'] = $datas['email'] : "";
        (!empty($datas['newsletters'])) ? $params['newsletters'] = $datas['newsletters'] : "";
        $this->set($params);
    }

    public function ActiveResetPassword($email)
    {
        $auth = $this->getBy(["email" => $_POST['email']])[0];
        $key = Tools::strRandom(15);
        if ($this->set(["id" => $auth->id, "resetkey" => "$key"])) {
            $Mailer = new Mail();
            $Mailer->setTo($this->getBy(["id" => $_SESSION['id']])[0]->email);
            $Mailer->setSubject(WEBSITE_NAME . " mot de passe oublié ?");
            $Mailer->setBody('En raison de la perte du mot de passe, voici ci-contre le lien pour pouvoir le réinitialiser.<br>
                                    <a href="' . URL . '/resetPassword/' . $key . '">Réinitialisé mon mot de passe</a>');
            $Mailer->send();
        }
        return true;
    }

    public function VerifKey($key)
    {
        if (!empty($auth = @$this->getBy(["resetkey" => "$key"])[0]) and $key != 0) {
            return true;
        } else {
    return false;
}
}

public function resetPassword($key, $post)
{
    if($this->VerifKey($key)) {
        if (@$post['passwordRepeat'] == @$post['password']) {
            $auth = $this->getBy(["resetkey" => "$key"])[0]->id;
            $this->set(["id" => $auth, "resetkey" => 0, "password" => password_hash($post['password'], PASSWORD_DEFAULT)]);
            return true;
        }else{
            return false;
        }
    }
}
}