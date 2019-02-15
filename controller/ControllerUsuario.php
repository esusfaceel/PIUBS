<?php
if (file_exists('../library/Import.php'))
    include_once '../library/Import.php';
elseif (file_exists('../../library/Import.php'))
    include_once '../../library/Import.php';
else
    include_once 'library/Import.php';

Import::dao('UsuarioDao');
Import::entidade('Usuario');
Import::config('Configuracao');
Import::library('Request');
Import::library('Redirect');
Import::library('Alert');
Import::controller('ControllerLog');
Import::controller('ControllerEmail');

class ControllerUsuario extends Request
{

    private $dao;

    private function getDao()
    {
        if ($this->dao == null) {
            $this->dao = new UsuarioDao();
        }
        return $this->dao;
    }

    public function cacheSave($location, $id = null)
    {
        $this->deleteSession('cadUser');
        if ($this->validaPost('avancar')) {
            $this->setSession('cadUser', $this->montaUsuario($id, $this->Post('name'), $this->Post('cpf'), $this->Post('rg'), $this->Post('sexo'), $this->Post('telefone'), $this->Post('dataNac'), $this->Post('email'), $this->Post('titulacao'), null, null, null, $this->Post('ies'), TRUE, null, null, null, FALSE));
            Redirect::Redirect_To_View($location);
        }
    }

    public function cadastraUser(Usuario $usuario = null)
    {
        if ($this->getSession('cadUser') == null)
            Redirect::Back();
        elseif ($this->validaPost('salvar')) {
            $usuario = $this->getSession('cadUser');
            $usuario->setIdAvatar($this->Post('avatar'));
            $usuario->setIdCargo($this->Post('cargo'));
            $usuario->setLogin($this->Post('login'));
            $usuario->setSenha(md5($this->Post('senha')));
            if (! $this->validaLogin($usuario->getLogin())) {
                if ($this->Post('senha') == $this->Post('csenha')) {
                    $log = new ControllerLog();
                    $log->log(ControllerLog::CADASTRO_USUARIO, $this->getDao()
                        ->insert($usuario), $this->getUsuarioLogado()
                        ->getId());
                    Redirect::Redirect_To_Index();
                    $this->setSession("sucesso", 'Usuário cadastrado com sucesso!');
                } else
                    Alert::err('As senhas não conferem!');
            } else
                Alert::err('Login não disponível!');
        }
    }

    protected function validaLogin($login, $id = null)
    {
        if ($id == null)
            return $this->getByLogin($login) != null;
        else
            return $this->getDao()->findByLoginAtivoDifferentId($login, $id) != null;
    }

    protected function getAvatares()
    {
        return $this->getDao()->findAllAvatares();
    }

    public function listAvatar()
    {
        if ($this->Get('id')) {
            foreach ($this->getAvatares() as $avatar) {
                $checked = ($avatar['idAvatar'] == $this->getById($this->Get('id'))
                    ->getIdAvatar()) ? "checked" : "";
                echo '<div class="col s3">
            	   <input name="avatar" type="radio"
            		value="' . $avatar['idAvatar'] . '"' . $checked . ' id="avatar' . $avatar['idAvatar'] . '" class="with-gap" />
                    <label for="avatar' . $avatar['idAvatar'] . '"><img
                	alt="avatar' . $avatar['idAvatar'] . '"
                	src="' . Configuracao::HOST_SERVER . "/model/img/avatar/" . $avatar['descricao'] . '"></label>
                    </div>';
            }
        } else {
            foreach ($this->getAvatares() as $avatar) {
                echo '<div class="col s3">
            	   <input name="avatar" type="radio"
            		value="' . $avatar['idAvatar'] . '" id="avatar' . $avatar['idAvatar'] . '" class="with-gap" />
                    <label for="avatar' . $avatar['idAvatar'] . '"><img
                	alt="avatar' . $avatar['idAvatar'] . '"
                	src="' . Configuracao::HOST_SERVER . "/model/img/avatar/" . $avatar['descricao'] . '"></label>
                    </div>';
            }
        }
    }

    protected function getByLogin($login)
    {
        return $this->getDao()->findByLoginAtivo($login);
    }

    public function removeFirstAccess()
    {
        if ($this->getUsuarioLogado()->getFirstAccess()) {
            $this->getDao()->updateFirstAccessById($this->getUsuarioLogado()
                ->getId());
            $this->getUsuarioLogado()->setFirstAccess(FALSE);
        }
    }

    public function getAllAtivos()
    {
        return $this->getDao()->findAllAtivas();
    }

    public function getById($id)
    {
        return $this->getDao()->findByIdAtivo($id);
    }

    public function login()
    {
        if ($this->validaPost('entrar')) {
            $usuario = $this->getDao()->findByLoginSenhaAtivo($this->Post('login'), md5($this->Post('password')));
            if ($usuario != null) {
                $this->setSession("login", $usuario);
                $log = new ControllerLog();
                $log->log(ControllerLog::ACESSO);
                if ($usuario->getLinkRecovery())
                    $this->getDao()->deleteTokenRecoveryPass($usuario->getId());
                Redirect::Redirect_To_Index();
            } else
                Alert::err("Login e/ou senha incorreto(s)!");
        }
    }

    public function solicitacaoRecoveryPassword()
    {
        if ($this->validaPost('recuperar')) {
            $usuario = $this->getDao()->findByLoginEmailAtivo($this->Post('login'), $this->Post('email'));

            if ($usuario != null) {
                $log = new ControllerLog();
                $log->log(ControllerLog::SOLICITACAO_RECOVERY_PASSWORD, $usuario->getId(), $usuario->getId());
                $email = new ControllerEmail();
                $link = Configuracao::HOST_SERVER . "/recoveryPassword/" . md5(uniqid(rand(), true)) . md5(uniqid(rand(), true));
                $send = $email->sendEmailRecoveryPassword($usuario->getEmail(), $usuario->getNome(), $link);
                if ($send !== TRUE)
                    Alert::err($send);
                else {
                    $this->getDao()->insertTokenRecoveryPass($usuario->getId(), $link);
                    $this->setSession("sucesso", $send);
                    Redirect::Redirect_To_View('login');
                }
            } else
                Alert::err("Login e/ou e-mail incorreto(s)!");
        }
    }

    public function validaToken()
    {
        if ($this->GetToken()) {
            $link = Configuracao::HOST_SERVER . "/recoveryPassword/" . $this->GetToken();
            $usuario = $this->getDao()->selecByLinkAndAtivo($link);
            if ($usuario != null) {
                if (date('Y-m-d H:i:s.000', strtotime('+3 hours', strtotime($usuario->getDataRecovery()))) <= date('Y-m-d H:i:s.000')) {
                    $this->setSession('recovery', $link);
                    Redirect::Redirect_To_View('AlterarSenha');
                } else {
                    Alert::err("Token inválido e/ou expirado!");
                }
            } else
                Alert::err("Token inválido e/ou expirado!");
        }
    }

    public function recoveryPassword($link)
    {
        if ($this->validaPost('recuperar')) {
            $this->deleteSession('recovery');
            $usuario = $this->getDao()->selecByLinkAndAtivo($link);
            if ($usuario != null) {
                if (date('Y-m-d H:i:s.000', strtotime('+3 hours', strtotime($usuario->getDataRecovery()))) <= date('Y-m-d H:i:s.000')) {
                    if ($this->Post('senha') == $this->Post('csenha')) {
                        $this->getDao()->updateSenhaByLinkRecoveryPass($link, md5($this->Post('senha')));
                        $log = new ControllerLog();
                        $log->log(ControllerLog::RECOVERY_PASSWORD, $usuario->getId(), $usuario->getId());
                        $this->getDao()->deleteTokenRecoveryPass($usuario->getId());
                        $this->setSession("sucesso", "Sua senha foi alterada");
                        Redirect::Redirect_To_View('login');
                    } else
                        Alert::err('As senhas não conferem!');
                } else {
                    $this->setSession('err', "Token inválido e/ou expirado!");
                    Redirect::Redirect_To_View('login');
                }
            } else {
                $this->setSession('err', "Token inválido e/ou expirado!");
                Redirect::Redirect_To_View('login');
            }
        }
    }

    public function getUsuarioLogado()
    {
        return $this->getSession("login");
    }

    public function update()
    {
        if ($this->validaPost('salvar')) {
            $usuario = $this->montaUsuario($this->Get('id'), $this->Post('name'), $this->Post('cpf'), $this->Post('rg'), $this->Post('sexo'), $this->Post('telefone'), $this->Post('dataNac'), $this->Post('email'), $this->Post('titulacao'), $this->getUsuarioLogado()
                ->getLogin(), $this->getUsuarioLogado()
                ->getSenha(), $this->getUsuarioLogado()
                ->getIdCargo(), $this->Post('ies'), TRUE, $this->getUsuarioLogado()
                ->getIdAvatar(), null, null, FALSE);
            $this->getDao()->update($usuario);

            $log = new ControllerLog();
            $log->log(ControllerLog::ALTERACAO_USUARIO, $this->Get('id'));

            if ($usuario->getId() == $this->getSession('login')->getId())
                $this->setSession('login', $usuario);
            $this->setSession("sucesso", 'Usuário alterado com sucesso!');
            Redirect::Redirect_To_Index();
        }
    }

    public function updateAcesso()
    {
        if ($this->validaPost('salvar')) {
            if (md5($this->Post('senhaAtual')) == $this->getUsuarioLogado()->getSenha()) {
                if ($this->Post('senha') == $this->Post('csenha')) {
                    $idCargo = ($this->Post('cargo')) ? $this->Post('cargo') : Security::COLABORADOR;
                    $this->getDao()->updateAcessso($this->montaUsuario($this->Get('id'), null, null, null, null, null, null, null, null, null, md5($this->Post('senha')), $idCargo, null, null, null, null, null, FALSE));

                    $log = new ControllerLog();
                    $log->log(ControllerLog::ALTERACAO_USUARIO, $this->Get('id'));

                    if ($this->Get('id') == $this->getUsuarioLogado()->getId()) {
                        $this->getUsuarioLogado()->setSenha(md5($this->Post('senha')));
                        $this->getUsuarioLogado()->setIdCargo($this->Post('cargo'));
                    }
                    $this->setSession("sucesso", 'Usuário alterado com sucesso!');
                    Redirect::Redirect_To_Index();
                } else
                    Alert::err('As senhas não conferem!');
            } else
                Alert::err('A senha está incorreta!');
        }
    }

    public function updateLogin()
    {
        if ($this->validaPost('salvar')) {
            if (md5($this->Post('senhaAtual')) == $this->getUsuarioLogado()->getSenha()) {
                if (! $this->validaLogin($this->Post('login'), $this->Get('id'))) {
                    $this->getDao()->updateLoginById($this->Get('id'), $this->Post('login'));

                    $log = new ControllerLog();
                    $log->log(ControllerLog::ALTERACAO_USUARIO, $this->Get('id'));

                    if ($this->Get('id') == $this->getUsuarioLogado()->getId())
                        $this->getUsuarioLogado()->setLogin($this->Post('login'));
                    $this->setSession("sucesso", 'Login alterado com sucesso!');
                    Redirect::Redirect_To_Index();
                } else
                    Alert::err('Login não disponível!');
            } else
                Alert::err('A senha está incorreta!');
        }
    }

    public function updateAvatar()
    {
        if ($this->validaPost('salvar')) {
            $this->getDao()->updateIdAvatarById($this->Get('id'), $this->Post('avatar'));

            $log = new ControllerLog();
            $log->log(ControllerLog::ALTERACAO_USUARIO, $this->Get('id'));

            if ($this->Get('id') == $this->getUsuarioLogado()->getId()) {
                $this->getUsuarioLogado()->setIdAvatar($this->Post('avatar'));
            }
            $this->setSession("sucesso", 'Avatar alterado com sucesso!');
            Redirect::Redirect_To_Index();
        }
    }

    public function firstAccess()
    {
        if ($this->getUsuarioLogado()->getFirstaccess()) {
            // if ($this->getUsuarioLogado()->getIdCargo() == 1) {
            $lista = array(
                array(
                    "id" => "navbar",
                    "mensagem" => "Menu de navegação para usufruir do sistema.",
                    "tipo" => "3"
                ),
                array(
                    "id" => "cadastro",
                    "mensagem" => "Click aqui para abrir o menu de cadastros.",
                    "tipo" => "1"
                ),
                array(
                    "id" => "cad",
                    "mensagem" => "Menu de cadastro.",
                    "tipo" => "3"
                ),
                array(
                    "id" => "consulta",
                    "mensagem" => "Click aqui para abrir o menu de consultas.",
                    "tipo" => "1"
                ),
                array(
                    "id" => "con",
                    "mensagem" => "Menu de consultas.<br> Você pode detalhar,<br> editar e deletar<br> dados do sistema.",
                    "tipo" => "3"
                ),
                array(
                    "id" => "rtec",
                    "mensagem" => "Click aqui para abrir o menu de relatórios técnicos.",
                    "tipo" => "1"
                ),
                array(
                    "id" => "visita",
                    "mensagem" => "Click aqui para cadastrar uma Visita In Loco.",
                    "tipo" => "3"
                ),
                array(
                    "id" => "rtec",
                    "mensagem" => "Click aqui para abrir o menu de relatórios técnicos.",
                    "tipo" => "1"
                ),
                array(
                    "id" => "solucao",
                    "mensagem" => "Click aqui para cadastrar uma Controvérsia/Solução.",
                    "tipo" => "4"
                )
            );

            $this->enjoyhint($lista);
            // } else {}
        }
    }

    private function enjoyhint(array $lista)
    {
        $pular = ", 'skipButton' : {className: \"mySkip\", text: \"Ignorar\"}";
        $avancar = ", 'nextButton' : {className: \"myNext\", text: \"Próximo\"}";
        echo "<script type='text/javascript'>
var enjoyhint_instance = new EnjoyHint({});
var enjoyhint_script_steps = [";
        $countList = count($lista);
        $i = 0;
        foreach ($lista as $l) {
            echo "{'";
            echo ($l['tipo'] == 1) ? "click " : (($l['tipo'] == 3) ? "next " : "skip ");
            echo "#" . $l['id'] . "' : '" . $l['mensagem'] . "'";
            echo ($l['tipo'] == 1 || $l['tipo'] == 4) ? $pular : (($l['tipo'] == 3) ? $avancar . $pular : "");
            echo "}";
            $i ++;
            echo ($i == $countList) ? "" : ", ";
        }
        echo "]; 
        enjoyhint_instance.set(enjoyhint_script_steps);
        enjoyhint_instance.run();
        </script>";
    }

    public function inative()
    {
        if ($this->validaPost('del')) {
            $this->getDao()->inative($this->Get('id'));

            $log = new ControllerLog();
            $log->log(ControllerLog::EXCLUSAO_USUARIO, $this->Get('id'));

            Redirect::Redirect_To_View('listUsers');
            $this->setSession("sucesso", 'Usuário deletado com sucesso!');
        }
    }

    public function montaUsuario($id, $nome, $cpf, $rg, $sexo, $celular, $dataNasc, $email, $idTitulacao, $login, $senha, $idCargo, $idIes, $ativo, $idAvatar, $linkRecovery, $dataRecovery, $firstAccess)
    {
        $usuario = new Usuario();
        $usuario->setId($id);
        $usuario->setNome($nome);
        $usuario->setCpf($cpf);
        $usuario->setRg($rg);
        $usuario->setSexo($sexo);
        $usuario->setCelular($celular);
        $usuario->setDataNasc($dataNasc);
        $usuario->setEmail($email);
        $usuario->setIdTitulacao($idTitulacao);
        $usuario->setLogin($login);
        $usuario->setSenha($senha);
        $usuario->setIdCargo($idCargo);
        $usuario->setIdIes($idIes);
        $usuario->setAtivo($ativo);
        $usuario->setIdAvatar($idAvatar);
        $usuario->setLinkRecovery($linkRecovery);
        $usuario->setDataRecovery($dataRecovery);
        $usuario->setFirstAccess($firstAccess);
        return $usuario;
    }
}
